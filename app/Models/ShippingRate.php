<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class ShippingRate extends Model
{
    use HasFactory;

    protected $fillable = [
        'province_name',
        'province_code',
        'cost_per_row',
        'estimated_days',
        'courier_name',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'cost_per_row' => 'integer',
            'is_active'    => 'boolean',
        ];
    }

    public function scopeActive(Builder $query): void
    {
        $query->where('is_active', true);
    }

    public function scopeByProvince(Builder $query, string $province): void
    {
        $query->where('province_name', 'like', "%{$province}%")
              ->orWhere('province_code', strtoupper($province));
    }

    public function getCostFormattedAttribute(): string
    {
        return 'Rp ' . number_format($this->cost_per_row, 0, ',', '.');
    }
}
