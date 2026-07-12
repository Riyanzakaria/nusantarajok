<?php

declare(strict_types=1);

namespace Tests\Unit;

use App\Models\CarVariant;
use App\Models\ProductModel;
use App\Models\ShippingRate;
use App\Services\OrderService;
use App\Services\ShippingService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Carbon\Carbon;

class OrderServiceTest extends TestCase
{
    use RefreshDatabase;

    private OrderService $orderService;

    protected function setUp(): void
    {
        parent::setUp();
        // Provide mock/stub for ShippingService if necessary, or just real one
        $this->orderService = new OrderService(new ShippingService());
    }

    public function test_it_generates_correct_invoice_number_format(): void
    {
        Carbon::setTestNow(Carbon::create(2026, 7, 12, 10, 0, 0));
        
        $invoice1 = $this->orderService->generateInvoiceNumber();
        $this->assertEquals('BJN-20260712-0001', $invoice1);

        // Mock that 1 order already exists today
        \App\Models\Order::factory()->create([
            'invoice_number' => 'BJN-20260712-0001'
        ]);

        $invoice2 = $this->orderService->generateInvoiceNumber();
        $this->assertEquals('BJN-20260712-0002', $invoice2);
    }

    public function test_it_calculates_correct_grand_total(): void
    {
        $product = ProductModel::factory()->create(['base_price' => 2500000]);
        $variant = CarVariant::factory()->create(['price_adjustment' => 100000]); // 2.6M
        $shipping = ShippingRate::factory()->create([
            'province_name' => 'Jawa Timur',
            'province_code' => 'JT', 
            'cost_per_row' => 75000
        ]);

        $data = [
            'product_model_id' => $product->id,
            'car_variant_id' => $variant->id,
            'seat_row' => '1',
            'primary_color' => 'Hitam',
            'secondary_color' => 'Merah',
            'customer_name' => 'Budi',
            'customer_wa' => '08123456789',
            'shipping_province' => 'Jawa Timur',
            'shipping_city' => 'Surabaya',
            'shipping_address' => 'Jl. Pahlawan',
        ];

        $order = $this->orderService->createOrder($data);

        // Product: 2.500.000 + 100.000 = 2.600.000
        // Shipping: 1 baris * 75.000 = 75.000
        // Grand Total: 2.675.000

        $this->assertEquals(2600000, $order->product_price);
        $this->assertEquals(75000, $order->shipping_cost);
        $this->assertEquals(2675000, $order->grand_total);
    }
}
