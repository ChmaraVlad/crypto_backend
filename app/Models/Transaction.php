<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
     protected $fillable = [
        'user_id',
        'coin_id',
        'type',
        'quantity',
        'price_per_unit',
    ];

    protected function casts(): array
    {
        return [
            'quantity'       => 'decimal:8',
            'price_per_unit' => 'decimal:8',
        ];
    }

    /**
     * Вычисляемый атрибут: итоговая сумма сделки.
     * Не хранится в БД, рассчитывается "на лету".
     * Доступен как $transaction->total_amount
     */
    public function getTotalAmountAttribute(): string
    {
        return bcmul($this->quantity, $this->price_per_unit, 8);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function coin(): BelongsTo
    {
        return $this->belongsTo(Coin::class);
    }
}
