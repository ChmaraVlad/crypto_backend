<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Alert extends Model
{
     protected $fillable = [
        'user_id',
        'coin_id',
        'target_price',
        'direction',
        'triggered_at',
    ];

    protected function casts(): array
    {
        return [
            'target_price' => 'decimal:8',
            'triggered_at' => 'datetime',
        ];
    }

    /**
     * Scope: только активные алерты (ещё не сработавшие).
     * Используется в Job проверки цен.
     *
     * @param Builder $query
     * @return Builder
     */
    public function scopeActive(Builder $query): Builder
    {
        return $query->whereNull('triggered_at');
    }

    /**
     * Scope: только выполненные алерты.
     * Используется для истории в UI.
     */
    public function scopeTriggered(Builder $query): Builder
    {
        return $query->whereNotNull('triggered_at');
    }

    /**
     * Проверить, должен ли алерт сработать при данной цене.
     * Инкапсулирует бизнес-логику внутри модели.
     */
    public function shouldTrigger(string $currentPrice): bool
    {
        return match($this->direction) {
            'above' => bccomp($currentPrice, $this->target_price, 8) >= 0,
            'below' => bccomp($currentPrice, $this->target_price, 8) <= 0,
        };
    }

    /**
     * Пометить алерт как выполненный.
     */
    public function markAsTriggered(): void
    {
        $this->update(['triggered_at' => now()]);
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
