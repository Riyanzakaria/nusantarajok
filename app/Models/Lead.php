<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Lead Model
 *
 * Prospek pelanggan dari kalkulator harga.
 * Terhubung ke work_orders (1 lead -> N work orders).
 */
#[Fillable(['customer_name', 'whatsapp_number', 'vehicle_type', 'material_selected', 'calculated_price', 'status', 'notes'])]
class Lead extends Model
{
    use HasFactory;
    protected function casts(): array
    {
        return [
            'calculated_price' => 'decimal:2',
        ];
    }

    /**
     * A lead can have multiple work orders (e.g., multi-vehicle project).
     */
    public function workOrders(): HasMany
    {
        return $this->hasMany(WorkOrder::class);
    }
}
