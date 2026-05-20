<?php

namespace App\Models;

use App\Observers\PricelistObserver;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * SettingsPricelist Model
 *
 * Represents a single item in the dynamic pricing matrix.
 * Observed by PricelistObserver for cache invalidation (Task 2.4).
 */
#[ObservedBy(PricelistObserver::class)]
#[Fillable(['vehicle_category_id', 'item_name', 'price'])]
class SettingsPricelist extends Model
{
    use HasFactory;

    protected $table = 'settings_pricelists';

    protected function casts(): array
    {
        return [
            'price' => 'decimal:2',
        ];
    }

    public function vehicleCategory()
    {
        return $this->belongsTo(VehicleCategory::class, 'vehicle_category_id');
    }
}
