<?php

declare(strict_types=1);

namespace App\Enums;

enum ProductionStatus: string
{
    case Waiting   = 'waiting';
    case Producing = 'producing';
    case Shipped   = 'shipped';
    case Delivered = 'delivered';

    public function label(): string
    {
        return match($this) {
            self::Waiting   => 'Menunggu Produksi',
            self::Producing => 'Sedang Diproduksi',
            self::Shipped   => 'Dikirim',
            self::Delivered => 'Diterima',
        };
    }

    public function stepNumber(): int
    {
        return match($this) {
            self::Waiting   => 1,
            self::Producing => 2,
            self::Shipped   => 3,
            self::Delivered => 4,
        };
    }

    public function color(): string
    {
        return match($this) {
            self::Waiting   => 'oklch(0.50 0.020 62)',   // muted
            self::Producing => 'oklch(0.72 0.14 80)',    // orange
            self::Shipped   => 'oklch(0.67 0.13 66)',    // cognac/gold
            self::Delivered => 'oklch(0.72 0.17 142)',   // green
        };
    }
}
