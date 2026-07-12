<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CarVariant;
use Illuminate\Http\Request;

class CarVariantController extends Controller
{
    public function index()
    {
        $variants = CarVariant::orderBy('brand')->orderBy('model_name')->get();
        return view('admin.car-variants.index', compact('variants'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'brand' => 'required|string|max:100',
            'model_name' => 'required|string|max:100',
            'year_range' => 'required|string|max:50',
            'seat_rows' => 'required|integer|min:1|max:3',
            'weight_per_row_kg' => 'required|numeric|min:1',
            'price_adjustment' => 'required|numeric',
        ]);

        $validated['has_row_1'] = true;
        $validated['has_row_2'] = $validated['seat_rows'] >= 2;
        $validated['has_row_3'] = $validated['seat_rows'] >= 3;
        $validated['is_active'] = $request->has('is_active');

        CarVariant::create($validated);

        return back()->with('success', 'Varian mobil berhasil ditambahkan.');
    }

    public function update(Request $request, CarVariant $carVariant)
    {
        $validated = $request->validate([
            'brand' => 'required|string|max:100',
            'model_name' => 'required|string|max:100',
            'year_range' => 'required|string|max:50',
            'seat_rows' => 'required|integer|min:1|max:3',
            'weight_per_row_kg' => 'required|numeric|min:1',
            'price_adjustment' => 'required|numeric',
        ]);

        $validated['has_row_1'] = true;
        $validated['has_row_2'] = $validated['seat_rows'] >= 2;
        $validated['has_row_3'] = $validated['seat_rows'] >= 3;
        $validated['is_active'] = $request->has('is_active');

        $carVariant->update($validated);

        return back()->with('success', 'Varian mobil berhasil diperbarui.');
    }

    public function destroy(CarVariant $carVariant)
    {
        try {
            $carVariant->delete();
            return back()->with('success', 'Varian mobil berhasil dihapus.');
        } catch (\Illuminate\Database\QueryException $e) {
            if ($e->getCode() === '23000') {
                return back()->with('error', 'Varian mobil tidak dapat dihapus karena sudah ada pesanan yang menggunakan varian ini.');
            }
            return back()->with('error', 'Terjadi kesalahan saat menghapus data.');
        }
    }
}
