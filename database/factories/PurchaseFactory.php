<?php

namespace Database\Factories;

use App\Models\Purchase;
use Illuminate\Database\Eloquent\Factories\Factory;

class PurchaseFactory extends Factory
{
    protected $model = Purchase::class;

    public function definition()
    {
        return [
            'status' => $this->faker->randomElement(['in_process', 'pending', 'paid', 'cancelled', 'deleted']),
            'supplier_id' => $this->faker->numberBetween(1, 35),
            'seller_id' => $this->faker->numberBetween(1, 35),
            'amount' => $this->faker->randomFloat(2, 0, 10000),
            'tax' => $this->faker->randomFloat(2, 0, 10),
            'discount' => $this->faker->randomFloat(2, 0, 1000),
            'accounting_document_id' => $this->faker->numberBetween(1, 10),
            'accounting_document_code' => 'AA-001',
            'total' => $this->faker->randomFloat(2, 0, 10000),
            'change' => $this->faker->randomFloat(2, 0, 500),
            'branch_id' => $this->faker->numberBetween(1, 10),
            'petty_cashes_id' => $this->faker->numberBetween(1, 35),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
