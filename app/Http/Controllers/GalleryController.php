<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Gallery;

class GalleryController extends Controller
{
    public function index()
    {
        $categories = Category::has('galleries')->orderBy('name')->get();
        $galleries = Gallery::with('category')->latest()->get();

        return view('gallery.index', compact('categories', 'galleries'));
    }
}
