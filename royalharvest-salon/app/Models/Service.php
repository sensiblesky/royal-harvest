<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $guarded = [];

    protected $casts = [
        'price_amount' => 'integer',
        'isActive' => 'boolean',
    ];

    /** Deposit percentage required to secure a booking. */
    public const DEPOSIT_PERCENT = 10;

    /** True when this service has an exact price and therefore requires a deposit. */
    public function requiresDeposit(): bool
    {
        return ! empty($this->price_amount);
    }

    /** Deposit amount in whole TZS (10% of the exact price), or null for custom-quote services. */
    public function depositAmount(): ?int
    {
        if (! $this->requiresDeposit()) {
            return null;
        }

        return (int) ceil($this->price_amount * self::DEPOSIT_PERCENT / 100);
    }
}
