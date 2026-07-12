<?php

declare(strict_types=1);

namespace App\Enums;

enum PaymentStatus: string
{
    case Unpaid  = 'unpaid';
    case Paid    = 'paid';
    case Expired = 'expired';
    case Failed  = 'failed';

    public function label(): string
    {
        return match($this) {
            self::Unpaid  => 'Menunggu Pembayaran',
            self::Paid    => 'Lunas',
            self::Expired => 'Kedaluwarsa',
            self::Failed  => 'Gagal',
        };
    }

    public function color(): string
    {
        return match($this) {
            self::Unpaid  => 'oklch(0.72 0.14 80)',   // orange
            self::Paid    => 'oklch(0.72 0.17 142)',   // green
            self::Expired => 'oklch(0.50 0.020 62)',   // muted
            self::Failed  => 'oklch(0.60 0.20 25)',    // red
        };
    }

    public function isPaid(): bool
    {
        return $this === self::Paid;
    }
}
