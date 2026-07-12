<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Enums\PaymentStatus;
use App\Enums\ProductionStatus;
use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Enum;

class OrderController extends Controller
{
    /**
     * Daftar semua pesanan masuk
     */
    public function index(Request $request)
    {
        $query = Order::with(['product', 'carVariant'])
            ->latest();

        // Filter by payment status
        if ($request->filled('payment')) {
            $query->where('payment_status', $request->payment);
        }

        // Filter by production status
        if ($request->filled('production')) {
            $query->where('production_status', $request->production);
        }

        // Search by invoice or customer
        if ($request->filled('q')) {
            $search = $request->q;
            $query->where(function ($q) use ($search) {
                $q->where('invoice_number', 'like', "%{$search}%")
                  ->orWhere('customer_name', 'like', "%{$search}%")
                  ->orWhere('customer_wa', 'like', "%{$search}%");
            });
        }

        $orders = $query->paginate(20)->withQueryString();

        // Summary stats
        $stats = [
            'total'     => Order::count(),
            'unpaid'    => Order::where('payment_status', 'unpaid')->count(),
            'producing' => Order::where('production_status', 'producing')->count(),
            'shipped'   => Order::where('production_status', 'shipped')->count(),
        ];

        return view('admin.orders.index', compact('orders', 'stats'));
    }

    /**
     * Detail satu pesanan
     */
    public function show(Order $order)
    {
        $order->load(['product', 'carVariant']);
        return view('admin.orders.show', compact('order'));
    }

    /**
     * Update status produksi + input nomor resi AWB
     */
    public function updateStatus(Request $request, Order $order)
    {
        $validated = $request->validate([
            'production_status' => ['required', new Enum(ProductionStatus::class)],
            'shipping_awb'      => 'nullable|string|max:100',
            'courier_name'      => 'nullable|string|max:100',
            'notes'             => 'nullable|string|max:1000',
        ]);

        // Jika status berubah ke Shipped, AWB wajib diisi
        if ($validated['production_status'] === 'shipped' && empty($validated['shipping_awb'])) {
            return back()->withErrors(['shipping_awb' => 'Nomor resi wajib diisi saat status diubah ke Dikirim.']);
        }

        $order->update($validated);

        return back()->with('success', "Status pesanan {$order->invoice_number} berhasil diperbarui.");
    }
}
