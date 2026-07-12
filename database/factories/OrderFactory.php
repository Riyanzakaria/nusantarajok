<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class OrderFactory extends Factory
{
    public function definition(): array
    {
        return [
            'invoice_number' => 'BJN-' . now()->format('Ymd') . '-' . str_pad((string)$this->faker->numberBetween(1, 999), 4, '0', STR_PAD_LEFT),
            'product_model_id' => \App\Models\ProductModel::factory(),
            'car_variant_id' => \App\Models\CarVariant::factory(),
            'seat_row' => '1',
            'primary_color' => 'Hitam',
            'customer_name' => $this->faker->name(),
            'customer_wa' => '08123456789',
            'shipping_province' => 'Jawa Timur',
            'shipping_city' => 'Surabaya',
            'shipping_address' => $this->faker->address(),
            'shipping_cost' => 75000,
            'product_price' => 2500000,
            'grand_total' => 2575000,
            'payment_status' => 'unpaid',
            'production_status' => 'waiting',
        ];
    }
}
