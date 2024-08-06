<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Branch;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Role>
 */
class RoleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => "Super Admin",
            'description' => "Administrador general",
            'branch_id' => 1,
        ];

        // return [
        //     'name' => $this->faker->unique()->jobTitle,
        //     'description' => $this->faker->optional()->sentence,
        //     'branch_id' => $this->faker->numberBetween(1, 10),
        // ];
    }
}
