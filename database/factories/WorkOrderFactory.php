<?php

namespace Database\Factories;

use App\Models\Lead;
use App\Models\WorkOrder;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<WorkOrder>
 */
class WorkOrderFactory extends Factory
{
    protected $model = WorkOrder::class;

    public function definition(): array
    {
        return [
            'lead_id'             => Lead::factory(),
            'raw_plat'            => fake()->regexify('[A-Z]{1,2} [0-9]{1,4} [A-Z]{1,3}'),
            'vehicle_type'        => fake()->randomElement(['Avanza', 'Innova', 'Bus Medium', 'Fortuner']),
            'work_units_required' => fake()->numberBetween(1, 3),
            'scheduled_at'        => fake()->dateTimeBetween('now', '+14 days')->format('Y-m-d'),
            'current_status'      => 'antrian',
        ];
    }
}
