<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\ProductModel;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductModelSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            [
                'name' => 'Jok Racing Recaro Style',
                'slug' => Str::slug('Jok Racing Recaro Style'),
                'description' => 'Desain terinspirasi dari Recaro dengan penyangga samping (side bolster) yang agresif untuk menahan tubuh saat bermanuver. Cocok untuk tampilan balap murni.',
                'base_price' => 2500000,
                'primary_image' => 'images/products/recaro-style.jpg',
                'gallery_images' => json_encode(['images/products/recaro-style-1.jpg', 'images/products/recaro-style-2.jpg']),
                'is_active' => true,
            ],
            [
                'name' => 'Jok Racing Sparco Style',
                'slug' => Str::slug('Jok Racing Sparco Style'),
                'description' => 'Desain elegan bergaya Sparco dengan aksen jahitan berlian (diamond cut) dan lubang harness. Menawarkan keseimbangan antara kenyamanan harian dan aura sporty.',
                'base_price' => 2800000,
                'primary_image' => 'images/products/sparco-style.jpg',
                'gallery_images' => json_encode(['images/products/sparco-style-1.jpg']),
                'is_active' => true,
            ],
        ];

        foreach ($products as $product) {
            ProductModel::updateOrCreate(
                ['slug' => $product['slug']],
                $product
            );
        }
    }
}
