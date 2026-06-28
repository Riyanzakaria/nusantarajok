<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\WorkOrder;
use Carbon\Carbon;
use Carbon\CarbonPeriod;

class ScheduleService
{
    /**
     * Kapasitas maksimal mobil per hari.
     */
    public const MAX_DAILY_CAPACITY = 2;

    /**
     * Dapatkan ketersediaan jadwal (booking) untuk beberapa hari ke depan.
     * 
     * @param int $daysAhead Jumlah hari ke depan untuk divisualisasikan.
     * @return array<string, array{date: string, dayName: string, status: string, count: int}>
     */
    public function getAvailability(int $daysAhead = 30): array
    {
        $startDate = Carbon::today();
        $endDate = Carbon::today()->addDays($daysAhead);

        // Ambil data jumlah booking per hari dari database (hindari N+1 query)
        $bookings = WorkOrder::selectRaw('DATE(scheduled_at) as date, count(*) as total')
            ->whereNotNull('scheduled_at')
            ->whereBetween('scheduled_at', [$startDate->format('Y-m-d'), $endDate->format('Y-m-d')])
            ->groupBy('date')
            ->get()
            ->keyBy('date');

        $calendar = [];
        $period = CarbonPeriod::create($startDate, $endDate);

        foreach ($period as $date) {
            $dateString = $date->format('Y-m-d');
            $isWeekend = $date->isWeekend(); // Sabtu (6) atau Minggu (0)

            if ($isWeekend) {
                $status = 'closed';
                $count = 0;
            } else {
                $count = isset($bookings[$dateString]) ? (int) $bookings[$dateString]->total : 0;
                
                if ($count >= self::MAX_DAILY_CAPACITY) {
                    $status = 'full';
                } elseif ($count === 1) {
                    $status = 'limited';
                } else {
                    $status = 'available';
                }
            }

            $calendar[$dateString] = [
                'date' => $dateString,
                'dayName' => $date->translatedFormat('l, d M'),
                'status' => $status,
                'count' => $count,
                'isPast' => $date->isBefore(Carbon::today()),
            ];
        }

        return array_values($calendar);
    }
}
