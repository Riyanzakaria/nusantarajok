<?php

namespace App\Services;

use App\Models\WorkOrder;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

/**
 * StitchFlowManager
 *
 * Inti logika bisnis STITCH-FLOW Engine:
 * - Kalkulasi kapasitas harian (Work Units)
 * - Deteksi overbooking
 * - Penjadwalan otomatis dengan earliest_start_date
 * - Pessimistic locking untuk concurrency control
 *
 * Blueprint §3B: "Sistem menghitung kapasitas harian (Work Units).
 * Jika kapasitas hari ini penuh, sistem otomatis menyarankan earliest_start_date berikutnya."
 */
class StitchFlowManager
{
    /**
     * Maksimum unit kerja per hari.
     * 1 unit = 1 kendaraan standar (mobil sedan/MPV).
     * Bus besar = 3-4 unit.
     */
    public const MAX_DAILY_UNITS = 5;

    /**
     * Check capacity and schedule a new work order.
     *
     * Uses DB::transaction + lockForUpdate() to prevent race conditions
     * when multiple requests try to book the same day simultaneously.
     *
     * @param  array  $orderData  Must contain: lead_id, raw_plat, vehicle_type, work_units_required, scheduled_at
     * @return WorkOrder The created work order
     *
     * @throws \App\Exceptions\CapacityExceededException
     */
    public function checkAndSchedule(array $orderData): WorkOrder
    {
        return DB::transaction(function () use ($orderData) {
            $requestedDate = Carbon::parse($orderData['scheduled_at']);
            $unitsRequested = (int) ($orderData['work_units_required'] ?? 1);

            // Pessimistic lock: hold all rows for this date until transaction completes.
            // This prevents a second concurrent request from reading stale capacity data.
            $usedUnits = WorkOrder::where('scheduled_at', $requestedDate->toDateString())
                ->lockForUpdate()
                ->sum('work_units_required');

            $remainingCapacity = self::MAX_DAILY_UNITS - $usedUnits;

            if ($unitsRequested > $remainingCapacity) {
                $earliestDate = $this->findEarliestAvailableDate($requestedDate, $unitsRequested);

                throw new \App\Exceptions\CapacityExceededException(
                    "Kapasitas tanggal {$requestedDate->format('d/m/Y')} penuh. "
                    . "Sisa unit: {$remainingCapacity}/{" . self::MAX_DAILY_UNITS . "}. "
                    . "Tanggal terdekat tersedia: {$earliestDate->format('d/m/Y')}.",
                    $earliestDate
                );
            }

            // Capacity available — create the order
            return WorkOrder::create([
                'lead_id'             => $orderData['lead_id'],
                'raw_plat'            => $orderData['raw_plat'],
                'vehicle_type'        => $orderData['vehicle_type'],
                'work_units_required' => $unitsRequested,
                'scheduled_at'        => $requestedDate->toDateString(),
                'current_status'      => 'antrian',
            ]);
        });
    }

    /**
     * Get remaining capacity for a specific date.
     */
    public function getRemainingCapacity(string|Carbon $date): int
    {
        $date = Carbon::parse($date);

        $usedUnits = WorkOrder::where('scheduled_at', $date->toDateString())
            ->sum('work_units_required');

        return max(0, self::MAX_DAILY_UNITS - $usedUnits);
    }

    /**
     * Find the earliest date that can accommodate the requested units.
     * Scans forward from the given date, max 30 days lookahead.
     */
    public function findEarliestAvailableDate(Carbon $fromDate, int $unitsNeeded): Carbon
    {
        $checkDate = $fromDate->copy()->addDay();

        for ($i = 0; $i < 30; $i++) {
            $usedUnits = WorkOrder::where('scheduled_at', $checkDate->toDateString())
                ->sum('work_units_required');

            if ((self::MAX_DAILY_UNITS - $usedUnits) >= $unitsNeeded) {
                return $checkDate;
            }

            $checkDate->addDay();
        }

        // Fallback: 31 days out (virtually impossible to be full)
        return $checkDate;
    }
}
