<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\VehicleCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class VehicleCategoryController extends Controller
{
    public function index()
    {
        $categories = VehicleCategory::orderBy('name')->get();
        return view('admin.vehicle-categories.index', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:vehicle_categories,name',
        ]);

        VehicleCategory::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
        ]);

        return redirect()->route('admin.vehicle-categories.index')
            ->with('success', 'Kategori Kendaraan berhasil ditambahkan.');
    }

    public function destroy(VehicleCategory $vehicleCategory)
    {
        if ($vehicleCategory->pricelists()->count() > 0) {
            return redirect()->back()->with('error', 'Kategori ini tidak dapat dihapus karena masih digunakan di Pricelist.');
        }

        $vehicleCategory->delete();

        return redirect()->route('admin.vehicle-categories.index')
            ->with('success', 'Kategori Kendaraan berhasil dihapus.');
    }
}
