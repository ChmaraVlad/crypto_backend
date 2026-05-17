<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Coin extends Model
{
     protected $fillable = [
        'ticker',
        'name',
        'current_price',
    ];

    protected function casts(): array
    {
        return [
            'current_price' => 'decimal:8',
        ];
    }

    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class);
    }

    public function alerts(): HasMany
    {
        return $this->hasMany(Alert::class);
    }
}
