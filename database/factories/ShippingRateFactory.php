<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ShippingRateFactory extends Factory
{
    public function definition(): array
    {
        return [
            'province_name' => $this->faker->state(),
            'province_code' => strtoupper($this->faker->lexify('??')),
            'cost_per_row' => 75000,
            'estimated_days' => '2-3 hari',
            'courier_name' => 'JNE Kargo',
            'is_active' => true,
        ];
    }
}
