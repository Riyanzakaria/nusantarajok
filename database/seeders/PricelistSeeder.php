<?php

namespace Database\Seeders;

use App\Models\SettingsPricelist;
use Illuminate\Database\Seeder;

/**
 * Seeds realistic pricelist data for development.
 */
class PricelistSeeder extends Seeder
{
    public function run(): void
    {
        $categories = ['2 Baris', '3 Baris', '4 Baris'];
        
        foreach ($categories as $cat) {
            $vehicleCategory = \App\Models\VehicleCategory::firstOrCreate([
                'name' => $cat,
                'slug' => \Illuminate\Support\Str::slug($cat)
            ]);

            $multiplier = 1;
            if ($cat == '3 Baris') $multiplier = 1.4;
            if ($cat == '4 Baris') $multiplier = 2.2;

            $materials = [
                ['item_name' => 'Sintetis Premium', 'price' => 3500000 * $multiplier],
                ['item_name' => 'Microfiber', 'price' => 5500000 * $multiplier],
                ['item_name' => 'Kulit Asli', 'price' => 12000000 * $multiplier],
                ['item_name' => 'Nappa Leather', 'price' => 18000000 * $multiplier]
            ];

            foreach ($materials as $material) {
                SettingsPricelist::updateOrCreate(
                    [
                        'vehicle_category_id' => $vehicleCategory->id,
                        'item_name' => $material['item_name']
                    ],
                    ['price' => $material['price']]
                );
            }
        }
    }
}
