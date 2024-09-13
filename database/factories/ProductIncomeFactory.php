<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProductIncome>
 */
class ProductIncomeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
           // 'purchase_price'  => fake()->numberBetween(10, 1000),
            'income_quantity' => fake()->numberBetween(1, 100),
            'created_at' => fake()->dateTimeInInterval('-100 days', '+99 days'),

        ];
    }
}
