<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Models\CarVariant;
use App\Models\Order;
use App\Models\ProductModel;
use App\Models\ShippingRate;
use App\Services\MidtransService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class CheckoutControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_creates_order_and_redirects_to_payment(): void
    {
        $product = ProductModel::factory()->create(['base_price' => 2500000]);
        $variant = CarVariant::factory()->create(['price_adjustment' => 100000]);
        ShippingRate::factory()->create(['province_name' => 'Jawa Timur', 'cost_per_row' => 75000]);

        Http::fake([
            'app.sandbox.midtrans.com/snap/v1/transactions' => Http::response([
                'token' => 'mocked-snap-token-12345',
                'redirect_url' => 'https://app.sandbox.midtrans.com/snap/v2/vtweb/mocked'
            ], 201)
        ]);

        $response = $this->post(route('checkout.store'), [
            'product_model_id' => $product->id,
            'car_variant_id' => $variant->id,
            'seat_row' => '1',
            'primary_color' => 'Hitam',
            'customer_name' => 'Budi',
            'customer_wa' => '08123456789',
            'shipping_province' => 'Jawa Timur',
            'shipping_city' => 'Surabaya',
            'shipping_address' => 'Jl. Pahlawan',
        ]);

        $order = Order::first();
        $this->assertNotNull($order);
        $this->assertEquals('mocked-snap-token-12345', $order->midtrans_snap_token);
        
        $response->assertRedirect(route('payment.show', $order->id));
    }
}
