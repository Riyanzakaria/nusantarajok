<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductModelFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->words(3, true),
            'slug' => $this->faker->slug(),
            'description' => $this->faker->sentence(),
            'base_price' => 2000000,
            'is_active' => true,
        ];
    }
}
