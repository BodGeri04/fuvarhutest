<?php

namespace Database\Factories;

use App\Models\Driver;
use App\Models\Job;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Job>
 */
class JobFactory extends Factory
{
    protected $model=Job::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'starting_address' => $this->faker->address(),
            'destination_address' => $this->faker->address(),
            'recipient_name' => $this->faker->name(),
            'recipient_phone' => $this->faker->phoneNumber(),
            'status' => $this->faker->randomElement(['Assigned', 'In Progress', 'Completed', 'Failed']),
            'driver_id' => Driver::factory(), // Kapcsolódó fuvarozó
        ];
    }
}
