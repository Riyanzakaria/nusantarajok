<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\ShippingRate;
use Illuminate\Database\Seeder;

class ShippingRateSeeder extends Seeder
{
    public function run(): void
    {
        // Flat ongkir kargo per provinsi (JNE Kargo / Lion Parcel)
        // Harga per baris jok, berat asumsi 25kg
        $rates = [
            ['province_name' => 'Jawa Timur',          'province_code' => 'JT',  'cost_per_row' => 75_000,  'estimated_days' => '1-2 hari'],
            ['province_name' => 'Jawa Tengah',          'province_code' => 'JTG', 'cost_per_row' => 85_000,  'estimated_days' => '1-2 hari'],
            ['province_name' => 'Jawa Barat',           'province_code' => 'JB',  'cost_per_row' => 100_000, 'estimated_days' => '2-3 hari'],
            ['province_name' => 'DKI Jakarta',          'province_code' => 'JKT', 'cost_per_row' => 110_000, 'estimated_days' => '2-3 hari'],
            ['province_name' => 'Banten',               'province_code' => 'BT',  'cost_per_row' => 105_000, 'estimated_days' => '2-3 hari'],
            ['province_name' => 'DI Yogyakarta',        'province_code' => 'YK',  'cost_per_row' => 80_000,  'estimated_days' => '1-2 hari'],
            ['province_name' => 'Bali',                 'province_code' => 'BA',  'cost_per_row' => 130_000, 'estimated_days' => '3-4 hari'],
            ['province_name' => 'Nusa Tenggara Barat',  'province_code' => 'NTB', 'cost_per_row' => 160_000, 'estimated_days' => '4-5 hari'],
            ['province_name' => 'Nusa Tenggara Timur',  'province_code' => 'NTT', 'cost_per_row' => 200_000, 'estimated_days' => '5-7 hari'],
            ['province_name' => 'Kalimantan Barat',     'province_code' => 'KB',  'cost_per_row' => 175_000, 'estimated_days' => '4-5 hari'],
            ['province_name' => 'Kalimantan Tengah',    'province_code' => 'KT',  'cost_per_row' => 185_000, 'estimated_days' => '4-5 hari'],
            ['province_name' => 'Kalimantan Selatan',   'province_code' => 'KS',  'cost_per_row' => 175_000, 'estimated_days' => '4-5 hari'],
            ['province_name' => 'Kalimantan Timur',     'province_code' => 'KI',  'cost_per_row' => 185_000, 'estimated_days' => '4-5 hari'],
            ['province_name' => 'Kalimantan Utara',     'province_code' => 'KU',  'cost_per_row' => 200_000, 'estimated_days' => '5-6 hari'],
            ['province_name' => 'Sulawesi Utara',       'province_code' => 'SA',  'cost_per_row' => 210_000, 'estimated_days' => '5-7 hari'],
            ['province_name' => 'Sulawesi Tengah',      'province_code' => 'ST',  'cost_per_row' => 210_000, 'estimated_days' => '5-7 hari'],
            ['province_name' => 'Sulawesi Selatan',     'province_code' => 'SN',  'cost_per_row' => 200_000, 'estimated_days' => '5-6 hari'],
            ['province_name' => 'Sulawesi Tenggara',    'province_code' => 'SG',  'cost_per_row' => 215_000, 'estimated_days' => '5-7 hari'],
            ['province_name' => 'Gorontalo',            'province_code' => 'GO',  'cost_per_row' => 220_000, 'estimated_days' => '5-7 hari'],
            ['province_name' => 'Sulawesi Barat',       'province_code' => 'SR',  'cost_per_row' => 220_000, 'estimated_days' => '5-7 hari'],
            ['province_name' => 'Maluku',               'province_code' => 'MA',  'cost_per_row' => 250_000, 'estimated_days' => '7-10 hari'],
            ['province_name' => 'Maluku Utara',         'province_code' => 'MU',  'cost_per_row' => 260_000, 'estimated_days' => '7-10 hari'],
            ['province_name' => 'Papua',                'province_code' => 'PA',  'cost_per_row' => 350_000, 'estimated_days' => '10-14 hari'],
            ['province_name' => 'Papua Barat',          'province_code' => 'PB',  'cost_per_row' => 350_000, 'estimated_days' => '10-14 hari'],
            ['province_name' => 'Papua Selatan',        'province_code' => 'PS',  'cost_per_row' => 375_000, 'estimated_days' => '10-14 hari'],
            ['province_name' => 'Papua Tengah',         'province_code' => 'PT',  'cost_per_row' => 375_000, 'estimated_days' => '10-14 hari'],
            ['province_name' => 'Papua Pegunungan',     'province_code' => 'PP',  'cost_per_row' => 400_000, 'estimated_days' => '12-15 hari'],
            ['province_name' => 'Aceh',                 'province_code' => 'AC',  'cost_per_row' => 220_000, 'estimated_days' => '5-7 hari'],
            ['province_name' => 'Sumatera Utara',       'province_code' => 'SU',  'cost_per_row' => 195_000, 'estimated_days' => '4-6 hari'],
            ['province_name' => 'Sumatera Barat',       'province_code' => 'SB',  'cost_per_row' => 200_000, 'estimated_days' => '4-6 hari'],
            ['province_name' => 'Riau',                 'province_code' => 'RI',  'cost_per_row' => 195_000, 'estimated_days' => '4-6 hari'],
            ['province_name' => 'Kepulauan Riau',       'province_code' => 'KR',  'cost_per_row' => 215_000, 'estimated_days' => '5-7 hari'],
            ['province_name' => 'Jambi',                'province_code' => 'JA',  'cost_per_row' => 185_000, 'estimated_days' => '4-5 hari'],
            ['province_name' => 'Sumatera Selatan',     'province_code' => 'SS',  'cost_per_row' => 175_000, 'estimated_days' => '3-5 hari'],
            ['province_name' => 'Kepulauan Bangka Belitung', 'province_code' => 'BB', 'cost_per_row' => 200_000, 'estimated_days' => '4-6 hari'],
            ['province_name' => 'Bengkulu',             'province_code' => 'BE',  'cost_per_row' => 185_000, 'estimated_days' => '4-6 hari'],
            ['province_name' => 'Lampung',              'province_code' => 'LA',  'cost_per_row' => 150_000, 'estimated_days' => '3-4 hari'],
        ];

        foreach ($rates as $rate) {
            ShippingRate::updateOrCreate(
                ['province_code' => $rate['province_code']],
                array_merge($rate, ['courier_name' => 'JNE Kargo', 'is_active' => true])
            );
        }
    }
}
