<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index()
    {
        $products = ProductModel::orderBy('name')->get();
        return view('admin.products.index', compact('products'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:product_models,name',
            'description' => 'nullable|string',
            'base_price' => 'required|numeric|min:0',
            'is_active' => 'boolean',
            'primary_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $validated['slug'] = Str::slug($validated['name']);
        $validated['is_active'] = $request->has('is_active');
        
        if ($request->hasFile('primary_image')) {
            $validated['primary_image'] = $request->file('primary_image')->store('products', 'public');
        }
        
        ProductModel::create($validated);

        return back()->with('success', 'Produk berhasil ditambahkan.');
    }

    public function update(Request $request, ProductModel $product)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:product_models,name,' . $product->id,
            'description' => 'nullable|string',
            'base_price' => 'required|numeric|min:0',
            'is_active' => 'boolean',
            'primary_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $validated['slug'] = Str::slug($validated['name']);
        $validated['is_active'] = $request->has('is_active');

        if ($request->hasFile('primary_image')) {
            if ($product->primary_image) {
                Storage::disk('public')->delete($product->primary_image);
            }
            $validated['primary_image'] = $request->file('primary_image')->store('products', 'public');
        }

        $product->update($validated);

        return back()->with('success', 'Produk berhasil diperbarui.');
    }

    public function destroy(ProductModel $product)
    {
        try {
            if ($product->primary_image) {
                Storage::disk('public')->delete($product->primary_image);
            }
            $product->delete();
            return back()->with('success', 'Produk berhasil dihapus.');
        } catch (\Illuminate\Database\QueryException $e) {
            if ($e->getCode() === '23000') {
                return back()->with('error', 'Produk tidak dapat dihapus karena sudah ada pesanan yang menggunakan produk ini.');
            }
            return back()->with('error', 'Terjadi kesalahan saat menghapus data.');
        }
    }
}
