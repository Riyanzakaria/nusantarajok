<?php

declare(strict_types=1);

namespace Tests\Unit;

use App\Models\Order;
use App\Services\MidtransService;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class MidtransServiceTest extends TestCase
{
    public function test_it_generates_snap_token_successfully(): void
    {
        config([
            'midtrans.server_key' => 'SB-Mid-server-testkey',
            'midtrans.environment' => 'sandbox',
        ]);

        // Mock HTTP request to Midtrans API
        Http::fake([
            'app.sandbox.midtrans.com/snap/v1/transactions' => Http::response([
                'token' => 'mocked-snap-token-12345',
                'redirect_url' => 'https://app.sandbox.midtrans.com/snap/v2/vtweb/mocked'
            ], 201)
        ]);

        // We use make() so it doesn't touch the real DB for this basic unit test
        $order = Order::factory()->make([
            'invoice_number' => 'BJN-TEST-001',
            'grand_total' => 2575000,
            'customer_name' => 'Budi',
            'customer_email' => 'budi@example.com',
            'customer_wa' => '08123456789',
        ]);

        $service = new MidtransService();
        $token = $service->createSnapToken($order);

        $this->assertEquals('mocked-snap-token-12345', $token);
        
        Http::assertSent(function (\Illuminate\Http\Client\Request $request) {
            return $request->url() == 'https://app.sandbox.midtrans.com/snap/v1/transactions' &&
                   $request['transaction_details']['order_id'] == 'BJN-TEST-001' &&
                   $request['transaction_details']['gross_amount'] == 2575000;
        });
    }

    public function test_it_verifies_webhook_signature_correctly(): void
    {
        config(['midtrans.server_key' => 'SB-Mid-server-testkey']);
        
        $payload = [
            'order_id' => 'BJN-TEST-001',
            'status_code' => '200',
            'gross_amount' => '2575000.00'
        ];
        
        // signature = hash('sha512', order_id + status_code + gross_amount + server_key)
        $validSignature = hash('sha512', 'BJN-TEST-0012002575000.00SB-Mid-server-testkey');
        
        $service = new MidtransService();
        
        $this->assertTrue($service->verifyWebhookSignature($payload, $validSignature));
        $this->assertFalse($service->verifyWebhookSignature($payload, 'invalid-signature'));
    }
}
