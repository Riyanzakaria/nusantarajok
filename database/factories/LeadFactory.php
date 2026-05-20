<?php

namespace Database\Factories;

use App\Models\Lead;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Lead>
 */
class LeadFactory extends Factory
{
    protected $model = Lead::class;

    public function definition(): array
    {
        return [
            'customer_name'    => fake()->name(),
            'whatsapp_number'  => '08' . fake()->numerify('##########'),
            'vehicle_type'     => fake()->randomElement(['Avanza', 'Innova', 'Bus Medium', 'Fortuner', 'Xpander']),
            'material_selected' => fake()->randomElement(['Kulit Sintetis', 'Kulit Asli', 'Fabric Premium']),
            'calculated_price' => fake()->randomFloat(2, 1500000, 15000000),
            'status'           => 'raw',
        ];
    }
}
