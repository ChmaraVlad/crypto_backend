<?php

namespace Database\Factories;

use App\Models\Coin;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Transaction>
 */
class TransactionFactory extends Factory
{
    public function definition(): array
    {
        $quantity      = $this->faker->randomFloat(8, 0.001, 10);
        $pricePerUnit  = $this->faker->randomFloat(8, 0.01, 70000);

        return [
            'user_id'        => User::factory(),
            'coin_id'        => Coin::inRandomOrder()->first()?->id ?? Coin::factory(),
            'type'           => $this->faker->randomElement(['buy', 'sell']),
            'quantity'       => number_format($quantity, 8, '.', ''),
            'price_per_unit' => number_format($pricePerUnit, 8, '.', ''),
        ];
    }
}
