<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\CarVariant;
use Illuminate\Database\Seeder;

class CarVariantSeeder extends Seeder
{
    public function run(): void
    {
        $variants = [
            ['brand' => 'Toyota', 'model_name' => 'Avanza / Veloz', 'year_range' => '2012-2021', 'seat_rows' => 3, 'price_adjustment' => 0],
            ['brand' => 'Toyota', 'model_name' => 'Avanza / Veloz', 'year_range' => '2022-Sekarang', 'seat_rows' => 3, 'price_adjustment' => 100000],
            ['brand' => 'Toyota', 'model_name' => 'Innova Reborn', 'year_range' => '2016-2022', 'seat_rows' => 3, 'price_adjustment' => 200000],
            ['brand' => 'Toyota', 'model_name' => 'Innova Zenix', 'year_range' => '2023-Sekarang', 'seat_rows' => 3, 'price_adjustment' => 250000],
            ['brand' => 'Toyota', 'model_name' => 'Rush', 'year_range' => '2018-Sekarang', 'seat_rows' => 3, 'price_adjustment' => 0],
            ['brand' => 'Toyota', 'model_name' => 'Fortuner VRZ', 'year_range' => '2016-Sekarang', 'seat_rows' => 3, 'price_adjustment' => 300000],
            ['brand' => 'Toyota', 'model_name' => 'Agya / Calya', 'year_range' => 'All Year', 'seat_rows' => 2, 'price_adjustment' => -100000],

            ['brand' => 'Honda', 'model_name' => 'Brio', 'year_range' => 'All Year', 'seat_rows' => 2, 'price_adjustment' => -100000],
            ['brand' => 'Honda', 'model_name' => 'HR-V', 'year_range' => '2015-2021', 'seat_rows' => 2, 'price_adjustment' => 100000],
            ['brand' => 'Honda', 'model_name' => 'HR-V', 'year_range' => '2022-Sekarang', 'seat_rows' => 2, 'price_adjustment' => 150000],
            ['brand' => 'Honda', 'model_name' => 'CR-V', 'year_range' => '2017-2023', 'seat_rows' => 3, 'price_adjustment' => 250000],

            ['brand' => 'Daihatsu', 'model_name' => 'Xenia', 'year_range' => '2012-2021', 'seat_rows' => 3, 'price_adjustment' => 0],
            ['brand' => 'Daihatsu', 'model_name' => 'Xenia', 'year_range' => '2022-Sekarang', 'seat_rows' => 3, 'price_adjustment' => 100000],
            ['brand' => 'Daihatsu', 'model_name' => 'Terios', 'year_range' => '2018-Sekarang', 'seat_rows' => 3, 'price_adjustment' => 0],
            ['brand' => 'Daihatsu', 'model_name' => 'Ayla / Sigra', 'year_range' => 'All Year', 'seat_rows' => 2, 'price_adjustment' => -100000],

            ['brand' => 'Mitsubishi', 'model_name' => 'Xpander', 'year_range' => 'All Year', 'seat_rows' => 3, 'price_adjustment' => 150000],
            ['brand' => 'Mitsubishi', 'model_name' => 'Pajero Sport', 'year_range' => '2016-Sekarang', 'seat_rows' => 3, 'price_adjustment' => 300000],

            ['brand' => 'Suzuki', 'model_name' => 'Ertiga', 'year_range' => 'All Year', 'seat_rows' => 3, 'price_adjustment' => 50000],
            ['brand' => 'Suzuki', 'model_name' => 'XL7', 'year_range' => 'All Year', 'seat_rows' => 3, 'price_adjustment' => 50000],
        ];

        foreach ($variants as $variant) {
            CarVariant::updateOrCreate(
                ['brand' => $variant['brand'], 'model_name' => $variant['model_name'], 'year_range' => $variant['year_range']],
                array_merge($variant, [
                    'has_row_1' => true,
                    'has_row_2' => true,
                    'has_row_3' => $variant['seat_rows'] === 3,
                    'weight_per_row_kg' => 25,
                    'is_active' => true,
                ])
            );
        }
    }
}
