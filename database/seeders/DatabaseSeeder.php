<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Монеты — статичные данные, реальные тикеры
        $this->call(CoinsSeeder::class);

        // 2. Тестовый пользователь с известными кредами для разработки
        User::factory()->create([
            'name'  => 'Test User',
            'email' => 'test@example.com',
        ]);

        // 3. Ещё 4 случайных пользователя
        User::factory(4)->create();
        $allUsers = $users->push($testUser);
        
        // Транзакції для кожного юзера
        $allUsers->each(function ($user) {
            Transaction::factory(rand(5, 15))->create(['user_id' => $user->id]);
            Alert::factory(rand(1, 5))->create(['user_id' => $user->id]);
            Alert::factory(rand(0, 2))->triggered()->create(['user_id' => $user->id]);
        });
    }
}
