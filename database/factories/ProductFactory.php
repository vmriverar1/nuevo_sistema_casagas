<?php

namespace Database\Factories;

use App\Models\Brand;
use App\Models\Branch;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{

    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->word,
            'barcode' => $this->faker->unique()->ean13,
            'photo' => 'default.jpg',
            'purchase_price' => $this->faker->randomFloat(2, 1, 1000),
            'sale_price' => $this->faker->randomFloat(2, 1, 2000),
            'stock' => $this->faker->numberBetween(1, 100),
            'minimum' => $this->faker->numberBetween(1, 10),
            'type' => $this->faker->randomElement(['producto', 'servicio', 'paquete']),
            'status' => $this->faker->randomElement(['activo', 'inactivo']),
            'car_registration' => $this->faker->randomElement(['activo', 'inactivo']),
            'branch_id' => $this->faker->numberBetween(1, 10),
            'brand_id' => $this->faker->numberBetween(1, 50),
            'data' => json_encode($this->faker->randomElements())
        ];
    }
}
