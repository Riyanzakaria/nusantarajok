<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Order;
use App\Services\MidtransService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class WebhookController extends Controller
{
    public function __construct(
        private readonly MidtransService $midtransService
    ) {}

    /**
     * Handle incoming Midtrans HTTP Notification (Webhook)
     */
    public function midtrans(Request $request)
    {
        $payload = $request->all();
        $signature = $payload['signature_key'] ?? '';

        // 1. Verify Signature to ensure the request actually came from Midtrans
        if (!$this->midtransService->verifyWebhookSignature($payload, $signature)) {
            Log::warning('Midtrans Webhook: Invalid Signature', $payload);
            return response()->json(['message' => 'Invalid signature'], 403);
        }

        $orderId = $payload['order_id'] ?? '';
        $transactionStatus = $payload['transaction_status'] ?? '';
        $fraudStatus = $payload['fraud_status'] ?? '';

        // If the order_id contains -RETRY-, strip it to get the original invoice_number
        $baseInvoice = preg_replace('/-RETRY-.*$/', '', $orderId);

        $order = Order::where('invoice_number', $baseInvoice)->first();

        if (!$order) {
            Log::warning("Midtrans Webhook: Order not found ({$orderId})");
            return response()->json(['message' => 'Order not found'], 404);
        }

        // 2. Process Transaction Status
        if ($transactionStatus == 'capture') {
            if ($fraudStatus == 'accept') {
                $order->markAsPaid();
            }
        } else if ($transactionStatus == 'settlement') {
            $order->markAsPaid();
        } else if ($transactionStatus == 'cancel' || $transactionStatus == 'deny' || $transactionStatus == 'expire') {
            $order->update(['payment_status' => 'failed']);
        } else if ($transactionStatus == 'pending') {
            $order->update(['payment_status' => 'unpaid']);
        }

        return response()->json(['message' => 'OK']);
    }
}
