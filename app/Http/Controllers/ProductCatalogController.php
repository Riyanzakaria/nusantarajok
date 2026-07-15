<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\ProductModel;
use Illuminate\View\View;

class ProductCatalogController extends Controller
{
    /**
     * Halaman katalog semua produk aktif.
     */
    public function index(): View
    {
        $products = ProductModel::active()
            ->orderBy('name')
            ->get();

        return view('products.index', compact('products'));
    }

    /**
     * Halaman detail satu produk.
     */
    public function show(string $slug): View
    {
        $product = ProductModel::active()
            ->where('slug', $slug)
            ->firstOrFail();

        return view('products.show', compact('product'));
    }
}
