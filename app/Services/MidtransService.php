<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Order;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class MidtransService
{
    private string $serverKey;
    private bool $isProduction;
    private string $baseUrl;

    public function __construct()
    {
        $this->serverKey = config('midtrans.server_key');
        $this->isProduction = config('midtrans.environment') === 'production';
        
        // Note: For snap API, URL is app.midtrans.com, while core API is api.midtrans.com
        // We are using Snap API for generating tokens.
        $this->baseUrl = $this->isProduction 
            ? 'https://app.midtrans.com/snap/v1' 
            : 'https://app.sandbox.midtrans.com/snap/v1';
    }

    /**
     * Get Midtrans Snap Token for an order
     */
    public function createSnapToken(Order $order, ?string $customOrderId = null): ?string
    {
        $payload = [
            'transaction_details' => [
                'order_id'     => $customOrderId ?? $order->invoice_number,
                'gross_amount' => $order->grand_total,
            ],
            'customer_details' => [
                'first_name' => $order->customer_name,
                'email'      => $order->customer_email,
                'phone'      => $order->customer_wa,
            ],
            // Optional: You can map item_details here if needed for richer invoice UI
            'item_details' => [
                [
                    'id'       => $order->product_model_id . '-' . $order->car_variant_id,
                    'price'    => $order->product_price,
                    'quantity' => 1,
                    'name'     => 'Jok Racing PNP',
                ],
                [
                    'id'       => 'SHIPPING',
                    'price'    => $order->shipping_cost,
                    'quantity' => 1,
                    'name'     => 'Ongkos Kirim Kargo',
                ]
            ]
        ];

        try {
            $request = Http::withBasicAuth($this->serverKey, '');
            
            if (!$this->isProduction) {
                $request->withoutVerifying(); // bypass SSL on local/sandbox
            }
            
            $response = $request->post("{$this->baseUrl}/transactions", $payload);

            if ($response->successful()) {
                return $response->json('token');
            }

            Log::error('Midtrans Snap Error: ' . $response->body());
            return null;
        } catch (\Exception $e) {
            Log::error('Midtrans Exception: ' . $e->getMessage());
            return null;
        }
    }

    /**
     * Verify HMAC SHA512 signature from Midtrans Webhook
     */
    public function verifyWebhookSignature(array $payload, string $signatureToMatch): bool
    {
        $orderId     = $payload['order_id'] ?? '';
        $statusCode  = $payload['status_code'] ?? '';
        $grossAmount = $payload['gross_amount'] ?? '';

        $stringToSign = $orderId . $statusCode . $grossAmount . $this->serverKey;
        $calculatedSignature = hash('sha512', $stringToSign);

        return hash_equals($calculatedSignature, $signatureToMatch);
    }
}
