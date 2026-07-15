<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\CarVariant;
use App\Models\Order;
use App\Models\ProductModel;
use App\Models\ShippingRate;
use App\Services\MidtransService;
use App\Services\OrderService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CheckoutController extends Controller
{
    public function __construct(
        private readonly OrderService $orderService,
        private readonly MidtransService $midtransService
    ) {}

    /**
     * Show the checkout form (to be implemented with real views later)
     */
    public function create(Request $request)
    {
        $product = ProductModel::active()->where('slug', $request->query('product'))->firstOrFail();
        $carVariants = CarVariant::active()->get()->groupBy('brand');
        $provinces = ShippingRate::active()->get(['province_name', 'cost_per_row']);

        return view('checkout.create', compact('product', 'carVariants', 'provinces'));
    }

    /**
     * Process checkout and create order
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_model_id'     => 'required|exists:product_models,id',
            'car_variant_id'       => 'required|exists:car_variants,id',
            'seat_row'             => 'required|string',
            'primary_color'        => 'required|string|max:50',
            'secondary_color'      => 'nullable|string|max:50',
            'customer_name'        => 'required|string|max:255',
            'customer_wa'          => 'required|string|max:20',
            'customer_email'       => 'nullable|email|max:255',
            'shipping_province'    => 'required|string',
            'shipping_city'        => 'required|string',
            'shipping_address'     => 'required|string',
            'shipping_postal_code' => 'nullable|string|max:10',
            'notes'                => 'nullable|string|max:500',
        ]);

        try {
            // 1. Create order in database using OrderService
            $order = $this->orderService->createOrder($validated);

            // 2. Generate Snap Token via MidtransService
            $snapToken = $this->midtransService->createSnapToken($order);

            if ($snapToken) {
                $order->update(['midtrans_snap_token' => $snapToken]);
            } else {
                // If token generation fails, we still created the order, but we can't show payment modal.
                // We could redirect to an error page or a fallback payment method (e.g. manual transfer via WA)
                Log::error("Failed to generate snap token for order: {$order->invoice_number}");
            }

            // 3. Redirect to payment page showing order summary & payment button
            return redirect()->route('payment.show', $order->id);

        } catch (\Exception $e) {
            Log::error("Checkout failed: " . $e->getMessage());
            return back()->withInput()->with('error', 'Gagal memproses pesanan. Silakan coba lagi.');
        }
    }
}
