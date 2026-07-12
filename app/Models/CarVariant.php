<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Builder;

class CarVariant extends Model
{
    use HasFactory;

    protected $fillable = [
        'brand',
        'model_name',
        'year_range',
        'seat_rows',
        'has_row_1',
        'has_row_2',
        'has_row_3',
        'weight_per_row_kg',
        'price_adjustment',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'has_row_1'          => 'boolean',
            'has_row_2'          => 'boolean',
            'has_row_3'          => 'boolean',
            'price_adjustment'   => 'integer',
            'weight_per_row_kg'  => 'integer',
            'is_active'          => 'boolean',
        ];
    }

    // ── Scopes ─────────────────────────────────────────────────────────────

    public function scopeActive(Builder $query): void
    {
        $query->where('is_active', true);
    }

    public function scopeByBrand(Builder $query, string $brand): void
    {
        $query->where('brand', $brand);
    }

    // ── Relations ──────────────────────────────────────────────────────────

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class, 'car_variant_id');
    }

    // ── Business Logic ─────────────────────────────────────────────────────

    /**
     * Calculate the final price for this variant given a product's base price.
     */
    public function finalPrice(ProductModel $product): int
    {
        return max(0, $product->base_price + $this->price_adjustment);
    }

    /**
     * Get available rows as array of row numbers.
     */
    public function availableRows(): array
    {
        $rows = [];
        if ($this->has_row_1) $rows[] = 1;
        if ($this->has_row_2) $rows[] = 2;
        if ($this->has_row_3) $rows[] = 3;
        return $rows;
    }

    public function getFullNameAttribute(): string
    {
        $name = "{$this->brand} {$this->model_name}";
        if ($this->year_range) {
            $name .= " ({$this->year_range})";
        }
        return $name;
    }
}
