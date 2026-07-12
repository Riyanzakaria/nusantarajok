<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\PaymentStatus;
use App\Enums\ProductionStatus;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Order extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'invoice_number',
        'product_model_id',
        'car_variant_id',
        'seat_row',
        'primary_color',
        'secondary_color',
        'customer_name',
        'customer_wa',
        'customer_email',
        'shipping_province',
        'shipping_city',
        'shipping_address',
        'shipping_postal_code',
        'courier_name',
        'shipping_cost',
        'shipping_awb',
        'product_price',
        'grand_total',
        'payment_status',
        'midtrans_snap_token',
        'payment_url',
        'paid_at',
        'production_status',
        'notes',
    ];

    protected function casts(): array
    {
        return [
            'payment_status'    => PaymentStatus::class,
            'production_status' => ProductionStatus::class,
            'shipping_cost'     => 'integer',
            'product_price'     => 'integer',
            'grand_total'       => 'integer',
            'paid_at'           => 'datetime',
        ];
    }

    // ── Relations ──────────────────────────────────────────────────────────

    public function product(): BelongsTo
    {
        return $this->belongsTo(ProductModel::class, 'product_model_id');
    }

    public function carVariant(): BelongsTo
    {
        return $this->belongsTo(CarVariant::class, 'car_variant_id');
    }

    // ── Scopes ─────────────────────────────────────────────────────────────

    public function scopeUnpaid($query): void
    {
        $query->where('payment_status', PaymentStatus::Unpaid);
    }

    public function scopePaid($query): void
    {
        $query->where('payment_status', PaymentStatus::Paid);
    }

    public function scopeOlderThan($query, int $days): void
    {
        $query->where('created_at', '<', now()->subDays($days));
    }

    // ── Accessors ──────────────────────────────────────────────────────────

    public function getGrandTotalFormattedAttribute(): string
    {
        return 'Rp ' . number_format($this->grand_total, 0, ',', '.');
    }

    public function getProductPriceFormattedAttribute(): string
    {
        return 'Rp ' . number_format($this->product_price, 0, ',', '.');
    }

    public function getShippingCostFormattedAttribute(): string
    {
        return 'Rp ' . number_format($this->shipping_cost, 0, ',', '.');
    }

    public function getCustomerWaLinkAttribute(): string
    {
        return 'https://wa.me/' . ltrim($this->customer_wa, '0');
    }

    public function getSeatRowLabelAttribute(): string
    {
        return match($this->seat_row) {
            '1'     => 'Baris Depan (1 Baris)',
            '1,2'   => 'Baris Depan + Tengah (2 Baris)',
            '1,2,3' => 'Full Set (3 Baris)',
            default => "Baris {$this->seat_row}",
        };
    }

    // ── Business Logic ─────────────────────────────────────────────────────

    public function isExpiredAndPrunable(): bool
    {
        return in_array($this->payment_status, [PaymentStatus::Expired, PaymentStatus::Failed])
            && $this->created_at->lt(now()->subDays(30));
    }

    public function markAsPaid(): void
    {
        $this->update([
            'payment_status' => PaymentStatus::Paid,
            'paid_at'        => now(),
            'production_status' => ProductionStatus::Producing,
        ]);
    }
}
