<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Gallery;
use Illuminate\Support\Str;

class GallerySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Big Bus' => Category::create(['name' => 'Big Bus', 'slug' => 'big-bus']),
            'Microbus' => Category::create(['name' => 'Microbus', 'slug' => 'microbus']),
            'SUV / MPV' => Category::create(['name' => 'SUV / MPV', 'slug' => 'suv-mpv']),
            'Sedan' => Category::create(['name' => 'Sedan', 'slug' => 'sedan']),
            'Detail Artisan' => Category::create(['name' => 'Detail Artisan', 'slug' => 'detail-artisan']),
        ];

        $galleries = [
            [
                'category_id' => $categories['Big Bus']->id,
                'image_url' => 'images/gallery/bus.png',
                'title' => 'VIP Bus Cabin',
                'is_featured' => true,
            ],
            [
                'category_id' => $categories['Detail Artisan']->id,
                'image_url' => 'images/gallery/craftsmanship.png',
                'title' => 'Presisi Jahitan Tangan',
                'is_featured' => true,
            ],
            [
                'category_id' => $categories['Microbus']->id,
                'image_url' => 'images/gallery/microbus.png',
                'title' => 'Hiace Executive Luxury',
                'is_featured' => true,
            ],
            [
                'category_id' => $categories['Sedan']->id,
                'image_url' => 'images/gallery/sedan.png',
                'title' => 'Sport Sedan Nappa Leather',
                'is_featured' => true,
            ],
            [
                'category_id' => $categories['SUV / MPV']->id,
                'image_url' => 'images/gallery/suv.png',
                'title' => 'Alphard VIP Lounge',
                'is_featured' => true,
            ],
            [
                'category_id' => $categories['Detail Artisan']->id,
                'image_url' => 'images/gallery/stitch_1.png',
                'title' => 'Diamond Cut Pattern',
                'is_featured' => true,
            ],
            [
                'category_id' => $categories['Detail Artisan']->id,
                'image_url' => 'images/gallery/stitch_2.png',
                'title' => 'Perforated Elegance',
                'is_featured' => false,
            ],
            [
                'category_id' => $categories['Detail Artisan']->id,
                'image_url' => 'images/gallery/texture_1.png',
                'title' => 'Premium Microfiber Texture',
                'is_featured' => false,
            ],
        ];

        foreach ($galleries as $gallery) {
            Gallery::create($gallery);
        }
    }
}
