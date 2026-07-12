<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Models\Order;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class WebhookControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_handles_successful_payment_webhook(): void
    {
        $order = Order::factory()->create([
            'invoice_number' => 'BJN-TEST-123',
            'grand_total' => 2500000,
            'payment_status' => 'unpaid'
        ]);

        config(['midtrans.server_key' => 'SB-Mid-server-testkey']);
        
        $payload = [
            'order_id' => 'BJN-TEST-123',
            'status_code' => '200',
            'gross_amount' => '2500000.00',
            'transaction_status' => 'settlement'
        ];
        
        $signature = hash('sha512', 'BJN-TEST-1232002500000.00SB-Mid-server-testkey');
        $payload['signature_key'] = $signature;

        $response = $this->postJson(route('webhook.midtrans'), $payload);

        $response->assertStatus(200);
        $this->assertDatabaseHas('orders', [
            'id' => $order->id,
            'payment_status' => 'paid',
            'production_status' => 'producing'
        ]);
    }
}
