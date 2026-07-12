<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProductModel extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'base_price',
        'primary_image',
        'gallery_images',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'base_price'     => 'integer',
            'gallery_images' => 'array',
            'is_active'      => 'boolean',
        ];
    }

    // ── Scopes ─────────────────────────────────────────────────────────────

    public function scopeActive($query): void
    {
        $query->where('is_active', true);
    }

    // ── Relations ──────────────────────────────────────────────────────────

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class, 'product_model_id');
    }

    // ── Accessors ──────────────────────────────────────────────────────────

    public function getBasePriceFormattedAttribute(): string
    {
        return 'Rp ' . number_format($this->base_price, 0, ',', '.');
    }
}
