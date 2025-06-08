<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Devices>
 */
class DevicesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
{
    $types = ['Ruang', 'Aula', 'Lab', 'Kantor', 'Studio', 'Production'];
    $sizes = ['Kecil', 'Sedang', 'Besar', 'VIP'];
    
    return [
        'device_name' => 'ESP-INV-'. fake()->unique()->bothify('###'),  // Tambah unique()
        'room' => fake()->randomElement($types).' '.
                 fake()->randomElement($sizes).' '.
                 fake()->numberBetween(1, 10),  // Ganti randomBetween() ke numberBetween()
    ];
}
}
