<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\VehicleCategory;
use App\Models\SettingsPricelist;
use Illuminate\Http\Request;

class PricelistController extends Controller
{
    /**
     * Display the pricelist management page with all items and categories.
     */
    public function index()
    {
        $pricelists = SettingsPricelist::with('vehicleCategory')
            ->get()
            ->sortBy(function($item) {
                return $item->vehicleCategory->name . '-' . $item->item_name;
            });

        $categories = VehicleCategory::orderBy('name')->get();

        return view('admin.pricelist.index', compact('pricelists', 'categories'));
    }

    /**
     * Store a new pricelist item.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'vehicle_category_id'  => 'required|exists:vehicle_categories,id',
            'item_name'            => 'required|string|max:150',
            'price'                => 'required|numeric|min:0',
        ]);

        SettingsPricelist::create($validated);

        return redirect()->route('admin.pricelist.index')
            ->with('success', 'Item harga berhasil ditambahkan.');
    }

    /**
     * Update an existing pricelist item.
     */
    public function update(Request $request, SettingsPricelist $pricelist)
    {
        $validated = $request->validate([
            'vehicle_category_id'  => 'required|exists:vehicle_categories,id',
            'item_name'            => 'required|string|max:150',
            'price'                => 'required|numeric|min:0',
        ]);

        $pricelist->update($validated);

        return redirect()->route('admin.pricelist.index')
            ->with('success', 'Item harga berhasil diperbarui.');
    }

    /**
     * Remove a pricelist item.
     */
    public function destroy(SettingsPricelist $pricelist)
    {
        $pricelist->delete();

        return redirect()->route('admin.pricelist.index')
            ->with('success', 'Item harga berhasil dihapus.');
    }
}
