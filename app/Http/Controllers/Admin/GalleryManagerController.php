<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryManagerController extends Controller
{
    public function index()
    {
        $galleries = Gallery::with('category')->latest()->get();
        $categories = Category::all();
        return view('admin.galleries.index', compact('galleries', 'categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'image' => 'required|image|max:2048',
            'title' => 'nullable|string|max:255',
            'is_featured' => 'boolean'
        ]);

        $path = $request->file('image')->store('galleries', 'public');

        Gallery::create([
            'category_id' => $request->category_id,
            'image_url' => Storage::disk('public')->url($path),
            'title' => $request->title,
            'is_featured' => $request->boolean('is_featured')
        ]);

        return back()->with('success', 'Foto berhasil diunggah.');
    }

    public function destroy(Gallery $gallery)
    {
        // Extract relative path from URL (e.g. /uploads/galleries/xxx -> galleries/xxx)
        // Storage::url() prefix is config('filesystems.disks.public.url')
        $prefix = Storage::disk('public')->url('');
        $path = str_replace($prefix, '', $gallery->image_url);
        
        Storage::disk('public')->delete($path);
        
        $gallery->delete();
        return back()->with('success', 'Foto berhasil dihapus.');
    }
}
