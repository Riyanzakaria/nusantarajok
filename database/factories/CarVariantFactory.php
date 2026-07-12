<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CarVariantFactory extends Factory
{
    public function definition(): array
    {
        return [
            'brand' => 'Toyota',
            'model_name' => $this->faker->word(),
            'year_range' => '2020-2023',
            'seat_rows' => 3,
            'has_row_1' => true,
            'has_row_2' => true,
            'has_row_3' => true,
            'weight_per_row_kg' => 25,
            'price_adjustment' => 0,
            'is_active' => true,
        ];
    }
}
