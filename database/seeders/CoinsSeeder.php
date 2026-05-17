<?php

namespace Database\Seeders;

use App\Models\Coin;
use Illuminate\Database\Seeder;

class CoinsSeeder extends Seeder
{
    /**
     * Заполняет таблицу монет реальными данными.
     * upsert() — вставит или обновит если уже существует (по ticker).
     * Безопасно запускать повторно.
     */
    public function run(): void
    {
        Coin::upsert([
            ['ticker' => 'BTC',  'name' => 'Bitcoin',   'current_price' => '67000.00000000'],
            ['ticker' => 'ETH',  'name' => 'Ethereum',  'current_price' => '3500.00000000'],
            ['ticker' => 'BNB',  'name' => 'BNB',       'current_price' => '580.00000000'],
            ['ticker' => 'SOL',  'name' => 'Solana',    'current_price' => '165.00000000'],
            ['ticker' => 'USDT', 'name' => 'Tether',    'current_price' => '1.00000000'],
            ['ticker' => 'XRP',  'name' => 'XRP',       'current_price' => '0.52000000'],
            ['ticker' => 'ADA',  'name' => 'Cardano',   'current_price' => '0.45000000'],
            ['ticker' => 'DOGE', 'name' => 'Dogecoin',  'current_price' => '0.15000000'],
        ], uniqueBy: ['ticker'], update: ['name', 'current_price']);
    }
}
