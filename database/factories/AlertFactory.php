<?php

namespace Database\Factories;

use App\Models\Alert;
use App\Models\Coin;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Alert>
 */
class AlertFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id'      => User::factory(),
            'coin_id'      => Coin::inRandomOrder()->first()?->id ?? Coin::factory(),
            'target_price' => number_format($this->faker->randomFloat(8, 0.01, 70000), 8, '.', ''),
            'direction'    => $this->faker->randomElement(['above', 'below']),
            'triggered_at' => null, // по умолчанию — активный алерт
        ];
    }

    /**
     * State: уже сработавший алерт (для истории).
     * Используется как Alert::factory()->triggered()->create()
     */
    public function triggered(): static
    {
        return $this->state(['triggered_at' => $this->faker->dateTimeBetween('-30 days')]);
    }
}
