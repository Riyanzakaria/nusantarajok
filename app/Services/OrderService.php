<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\CarVariant;
use App\Models\Order;
use App\Models\ProductModel;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class OrderService
{
    public function __construct(
        private readonly ShippingService $shippingService
    ) {}

    /**
     * Generate a unique invoice number format: BJN-YYYYMMDD-XXXX
     */
    public function generateInvoiceNumber(): string
    {
        $today = Carbon::now();
        $dateStr = $today->format('Ymd');
        
        $prefix = "BJN-{$dateStr}-";

        // Get the last order from today
        $lastOrder = Order::where('invoice_number', 'like', "{$prefix}%")
            ->orderBy('invoice_number', 'desc')
            ->first();

        $sequence = 1;
        if ($lastOrder) {
            $lastSequence = (int) substr($lastOrder->invoice_number, -4);
            $sequence = $lastSequence + 1;
        }

        return $prefix . str_pad((string) $sequence, 4, '0', STR_PAD_LEFT);
    }

    /**
     * Create a new order with calculated pricing
     */
    public function createOrder(array $data): Order
    {
        return DB::transaction(function () use ($data) {
            $product = ProductModel::findOrFail($data['product_model_id']);
            $variant = CarVariant::findOrFail($data['car_variant_id']);
            
            // Calc product price
            $productPrice = $variant->finalPrice($product);

            // Calc shipping
            $shippingCost = 0;
            $rate = $this->shippingService->getRate($data['shipping_province']);
            
            if ($rate) {
                // If they buy multiple rows (e.g. seat_row='1,2'), parse it.
                // For now MVP, seat_row represents the specific row chosen, which is 1 set per checkout.
                // But the user might be checking out "Baris 1 & 2" depending on how we model it. 
                // Let's assume 1 row = 1 unit of cost for simplicity. If seat_row length > 1, multiply.
                $rowCount = substr_count((string)$data['seat_row'], ',') + 1;
                $shippingCost = $rate->cost_per_row * $rowCount;
            }

            $order = Order::create([
                'invoice_number'       => $this->generateInvoiceNumber(),
                'product_model_id'     => $product->id,
                'car_variant_id'       => $variant->id,
                'seat_row'             => (string)$data['seat_row'],
                'primary_color'        => $data['primary_color'],
                'secondary_color'      => $data['secondary_color'] ?? null,
                'customer_name'        => $data['customer_name'],
                'customer_wa'          => $data['customer_wa'],
                'customer_email'       => $data['customer_email'] ?? null,
                'shipping_province'    => $data['shipping_province'],
                'shipping_city'        => $data['shipping_city'],
                'shipping_address'     => $data['shipping_address'],
                'shipping_postal_code' => $data['shipping_postal_code'] ?? null,
                'shipping_cost'        => $shippingCost,
                'product_price'        => $productPrice,
                'grand_total'          => $productPrice + $shippingCost,
            ]);

            return $order;
        });
    }
}
