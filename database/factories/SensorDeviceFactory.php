<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Devices;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SensorDevice>
 */
class SensorDeviceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'device_id' => Devices::factory(),
            'temperature' => fake()->numberBetween(20, 32),
            'humidity' => fake()->numberBetween(50,70),
            'status_relay' => fake()->numberBetween(0,1),
            'update_at' => now()
        ];
    }
}
