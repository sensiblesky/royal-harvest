<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Booking extends Model
{
    protected $guarded = [];

    protected $casts = [
        'isDone' => 'boolean',
        'sms_sent' => 'boolean',
        'admin_sms_sent' => 'boolean',
        'service_amount' => 'integer',
        'deposit_amount' => 'integer',
        'paid_at' => 'datetime',
    ];

    protected static function booted(): void
    {
        static::creating(function (Booking $booking) {
            $booking->uid ??= (string) Str::uuid();
            $booking->pay_token ??= self::generatePayToken();
        });
    }

    /** Bind route-model parameters by the opaque uid, never the sequential id. */
    public function getRouteKeyName(): string
    {
        return 'uid';
    }

    private static function generatePayToken(): string
    {
        do {
            // 8 chars, unambiguous alphabet (no 0/O/1/I) for short SMS links.
            $token = collect(str_split('ABCDEFGHJKLMNPQRSTUVWXYZ23456789'))
                ->random(8)->implode('');
        } while (static::where('pay_token', $token)->exists());

        return $token;
    }

    public function isPaid(): bool
    {
        return $this->payment_status === 'paid';
    }

    public function needsPayment(): bool
    {
        return in_array($this->payment_status, ['unpaid', 'pending'], true)
            && ! empty($this->deposit_amount);
    }
}
