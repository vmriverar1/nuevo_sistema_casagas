<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Branch>
 */
class BranchFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'company_name' => "Casagas",
            'email' => "casagas@gmail.com",
            'ruc' => "1234567890",
            'main_address' => "J",
            'secondary_address' => "Jr. Cajamarca 123",
            'main_phone' => "999999999",
            'secondary_phone' => "999999999",
            'photo' => 'default.jpg',
            'status' => "activa",
            'branch_type' => "central",
            'notes' => "Es una empresa de gas",
            'data' => json_encode(['key' => $this->faker->word]),
            'cun' => Str::uuid()->toString(),
            'created_at' => now(),
            'updated_at' => now(),
        ];

        // return [
        //     'company_name' => $this->faker->company,
        //     'email' => $this->faker->unique()->safeEmail,
        //     'ruc' => $this->faker->numerify('##########'),
        //     'main_address' => $this->faker->address,
        //     'secondary_address' => $this->faker->address,
        //     'main_phone' => $this->faker->phoneNumber,
        //     'secondary_phone' => $this->faker->phoneNumber,
        //     'photo' => 'default.jpg',
        //     'status' => $this->faker->randomElement(['activa', 'inactiva', 'mantenimiento']),
        //     'branch_type' => $this->faker->randomElement(['central', 'sucursal', 'otro']),
        //     'notes' => $this->faker->paragraph,
        //     'data' => json_encode(['key' => $this->faker->word]),
        //     'cun' => Str::uuid()->toString(),
        //     'created_at' => now(),
        //     'updated_at' => now(),
        // ];
    }
}
