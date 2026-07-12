<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ShippingRate;
use Illuminate\Http\Request;

class ShippingRateController extends Controller
{
    public function index()
    {
        $rates = ShippingRate::orderBy('province_name')->get();
        return view('admin.shipping-rates.index', compact('rates'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'province_name' => 'required|string|max:100|unique:shipping_rates',
            'cost_per_row' => 'required|numeric|min:0',
            'estimated_days' => 'required|string|max:50',
            'courier_name' => 'nullable|string|max:255',
        ]);

        $validated['province_code'] = \Illuminate\Support\Str::slug(substr($validated['province_name'], 0, 8));
        $validated['is_active'] = $request->has('is_active');
        $validated['courier_name'] = $validated['courier_name'] ?? 'Kargo Nusantara';

        ShippingRate::create($validated);

        return back()->with('success', 'Tarif ongkir berhasil ditambahkan.');
    }

    public function update(Request $request, ShippingRate $shippingRate)
    {
        $validated = $request->validate([
            'province_name' => 'required|string|max:100|unique:shipping_rates,province_name,' . $shippingRate->id,
            'cost_per_row' => 'required|numeric|min:0',
            'estimated_days' => 'required|string|max:50',
            'courier_name' => 'nullable|string|max:255',
        ]);

        $validated['province_code'] = \Illuminate\Support\Str::slug(substr($validated['province_name'], 0, 8));
        $validated['is_active'] = $request->has('is_active');
        $validated['courier_name'] = $validated['courier_name'] ?? 'Kargo Nusantara';

        $shippingRate->update($validated);

        return back()->with('success', 'Tarif ongkir berhasil diperbarui.');
    }

    public function destroy(ShippingRate $shippingRate)
    {
        $shippingRate->delete();
        return back()->with('success', 'Tarif ongkir berhasil dihapus.');
    }
}
