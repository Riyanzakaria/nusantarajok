<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * Show the payment waiting page with Midtrans Snap UI
     */
    public function show(string $id)
    {
        $order = Order::with(['product', 'carVariant'])->findOrFail($id);

        // If order is already paid, redirect to success/tracking page
        if ($order->payment_status->isPaid()) {
            return redirect()->route('tracking.show', $order->invoice_number)
                ->with('success', 'Pembayaran berhasil, pesanan sedang diproses.');
        }

        return view('payment.show', compact('order'));
    }

    /**
     * Regenerate Midtrans Snap Token to change payment method
     */
    public function regenerate(string $id, \App\Services\MidtransService $midtransService)
    {
        $order = Order::findOrFail($id);
        
        if ($order->payment_status->isPaid()) {
            return back()->with('error', 'Pesanan sudah dibayar.');
        }

        // Generate a new token by appending -RETRY- to the order ID so Midtrans sees it as a new transaction request
        $midtransOrderId = $order->invoice_number . '-RETRY-' . strtoupper(\Illuminate\Support\Str::random(5));
        
        $snapToken = $midtransService->createSnapToken($order, $midtransOrderId);

        if ($snapToken) {
            $order->update(['midtrans_snap_token' => $snapToken]);
            return back()->with('success', 'Metode pembayaran berhasil di-reset. Silakan pilih metode pembayaran baru.');
        }

        return back()->with('error', 'Gagal memuat ulang token pembayaran. Silakan coba lagi.');
    }
}
