<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * WorkOrder Model
 *
 * Inti dari STITCH-FLOW Engine.
 * Menyimpan data pengerjaan kendaraan dengan normalisasi plat nomor otomatis.
 *
 * Boot method: auto-normalizes raw_plat -> normalized_plat on creating/updating.
 */
#[Fillable([
    'lead_id', 'raw_plat', 'normalized_plat', 'vehicle_type',
    'work_units_required', 'scheduled_at', 'current_status',
])]
class WorkOrder extends Model
{
    use HasFactory;
    /**
     * Status progression for the liquid progress tracker (Milestone 3).
     */
    public const STATUS_STEPS = [
        'antrian'   => 0,
        'proses'    => 1,
        'selesai'   => 2,
    ];

    public const TOTAL_STEPS = 2;

    protected function casts(): array
    {
        return [
            'scheduled_at' => 'date',
            'work_units_required' => 'integer',
        ];
    }

    /**
     * Auto-normalize plate number on create and update.
     */
    protected static function booted(): void
    {
        static::creating(function (WorkOrder $order) {
            $order->normalized_plat = self::normalizePlate($order->raw_plat);
        });

        static::updating(function (WorkOrder $order) {
            if ($order->isDirty('raw_plat')) {
                $order->normalized_plat = self::normalizePlate($order->raw_plat);
            }
        });
    }

    /**
     * Normalize a plate number: strip all non-alphanumeric chars, uppercase.
     *
     * "b  8888  xZ"   → "B8888XZ"
     * "AE-1234-BZ"    → "AE1234BZ"
     * "ae 1234 bz  "  → "AE1234BZ"
     */
    public static function normalizePlate(string $raw): string
    {
        return strtoupper(preg_replace('/[^A-Za-z0-9]/', '', $raw));
    }

    /**
     * Get the progress percentage (0-100) for the liquid tracker.
     */
    public function getProgressPercentAttribute(): int
    {
        $step = self::STATUS_STEPS[$this->current_status] ?? 0;

        return (int) round(($step / self::TOTAL_STEPS) * 100);
    }

    /**
     * The lead that originated this work order.
     */
    public function lead(): BelongsTo
    {
        return $this->belongsTo(Lead::class);
    }
}
