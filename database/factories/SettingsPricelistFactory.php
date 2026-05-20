<?php

namespace Database\Factories;

use App\Models\SettingsPricelist;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<SettingsPricelist>
 */
class SettingsPricelistFactory extends Factory
{
    protected $model = SettingsPricelist::class;

    public function definition(): array
    {
        return [
            'category'            => fake()->randomElement(['material', 'jasa']),
            'item_name'           => fake()->words(2, true),
            'base_price_per_meter' => fake()->randomFloat(2, 50000, 500000),
            'service_fee'         => fake()->randomFloat(2, 100000, 1000000),
        ];
    }
}
