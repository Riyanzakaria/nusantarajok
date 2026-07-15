<?php

declare(strict_types=1);

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

    public function create()
    {
        return view('admin.products.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'           => 'required|string|max:255|unique:product_models,name',
            'description'    => 'nullable|string',
            'base_price'     => 'required|numeric|min:0',
            'is_active'      => 'boolean',
            'primary_image'  => 'nullable|image|mimes:jpeg,png,jpg,webp|max:4096',
            'gallery_images' => 'nullable|array|max:8',
            'gallery_images.*' => 'image|mimes:jpeg,png,jpg,webp|max:4096',
        ]);

        $validated['slug']      = Str::slug($validated['name']);
        $validated['is_active'] = $request->has('is_active');

        if ($request->hasFile('primary_image')) {
            $validated['primary_image'] = $request->file('primary_image')->store('products', 'public');
        }

        $galleryPaths = [];
        if ($request->hasFile('gallery_images')) {
            foreach ($request->file('gallery_images') as $file) {
                $galleryPaths[] = $file->store('products', 'public');
            }
        }
        $validated['gallery_images'] = $galleryPaths;

        ProductModel::create($validated);

        return redirect()->route('admin.products.index')
            ->with('success', 'Produk berhasil ditambahkan.');
    }

    public function edit(ProductModel $product)
    {
        return view('admin.products.edit', compact('product'));
    }

    public function update(Request $request, ProductModel $product)
    {
        $validated = $request->validate([
            'name'           => 'required|string|max:255|unique:product_models,name,' . $product->id,
            'description'    => 'nullable|string',
            'base_price'     => 'required|numeric|min:0',
            'is_active'      => 'boolean',
            'primary_image'  => 'nullable|image|mimes:jpeg,png,jpg,webp|max:4096',
            'gallery_images' => 'nullable|array|max:8',
            'gallery_images.*' => 'image|mimes:jpeg,png,jpg,webp|max:4096',
            'remove_gallery' => 'nullable|array',
            'remove_gallery.*' => 'string',
        ]);

        $validated['slug']      = Str::slug($validated['name']);
        $validated['is_active'] = $request->has('is_active');

        // Handle primary image replacement
        if ($request->hasFile('primary_image')) {
            if ($product->primary_image) {
                Storage::disk('public')->delete($product->primary_image);
            }
            $validated['primary_image'] = $request->file('primary_image')->store('products', 'public');
        }

        // Handle gallery: remove checked, keep rest, add new uploads
        $existingGallery = $product->gallery_images ?? [];
        $toRemove = $request->input('remove_gallery', []);

        // Delete removed files from storage
        foreach ($toRemove as $path) {
            Storage::disk('public')->delete($path);
        }

        // Keep images that were not removed
        $keptGallery = array_values(array_filter($existingGallery, fn($p) => !in_array($p, $toRemove)));

        // Add new uploads
        if ($request->hasFile('gallery_images')) {
            foreach ($request->file('gallery_images') as $file) {
                $keptGallery[] = $file->store('products', 'public');
            }
        }

        $validated['gallery_images'] = $keptGallery;

        $product->update($validated);

        return redirect()->route('admin.products.index')
            ->with('success', 'Produk berhasil diperbarui.');
    }

    public function destroy(ProductModel $product)
    {
        try {
            if ($product->primary_image) {
                Storage::disk('public')->delete($product->primary_image);
            }
            foreach ($product->gallery_images ?? [] as $path) {
                Storage::disk('public')->delete($path);
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
