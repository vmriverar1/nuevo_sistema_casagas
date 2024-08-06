<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactoryAnonim extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id' => "0",
            'name' => "Anónimo",
            'password' => Hash::make('password'), // Contraseña por defecto
            'email' => "anonimo@gmail.com",
            'document' => "00000000",
            'phone' => "000000000",
            'address' => $this->faker->address,
            'birthday' => $this->faker->date,
            'photo' => 'default.jpg',
            'profile' => 'cliente',
            'last_login' => $this->faker->dateTime,
            'data' => json_encode(['key' => $this->faker->word]),
            'email_verified_at' => $this->faker->optional()->dateTime,
            'remember_token' => $this->faker->optional()->sha256,
            'created_at' => now(),
            'updated_at' => now(),
        ];

        // return [
        //     'name' => $this->faker->name,
        //     'password' => Hash::make('password'), // Contraseña por defecto
        //     'email' => $this->faker->unique()->safeEmail,
        //     'document' => $this->faker->unique()->numerify('##########'),
        //     'phone' => $this->faker->phoneNumber,
        //     'address' => $this->faker->address,
        //     'birthday' => $this->faker->date,
        //     'photo' => 'default.jpg',
        //     'profile' => $this->faker->randomElement(['usuario', 'cliente', 'proveedor']),
        //     'last_login' => $this->faker->dateTime,
        //     'data' => json_encode(['key' => $this->faker->word]),
        //     'email_verified_at' => $this->faker->optional()->dateTime,
        //     'remember_token' => $this->faker->optional()->sha256,
        //     'created_at' => now(),
        //     'updated_at' => now(),
        // ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
