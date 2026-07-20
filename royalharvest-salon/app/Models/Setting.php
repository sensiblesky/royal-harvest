<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Crypt;

class Setting extends Model
{
    protected $primaryKey = 'key';
    protected $keyType = 'string';
    public $incrementing = false;
    protected $guarded = [];

    /** Keys whose values are encrypted at rest (secrets). */
    public const SECRET_KEYS = [
        'snippe_api_key',
        'beem_api_key',
        'beem_secret_key',
    ];

    /**
     * Read a setting, falling back to config()/env when not set in the DB.
     */
    public static function get(string $key, $default = null)
    {
        $value = Cache::rememberForever("setting.$key", function () use ($key) {
            $row = static::query()->find($key);

            return $row?->value;
        });

        if ($value === null || $value === '') {
            return $default;
        }

        if (in_array($key, self::SECRET_KEYS, true)) {
            try {
                return Crypt::decryptString($value);
            } catch (\Throwable $e) {
                return $default;
            }
        }

        return $value;
    }

    /**
     * Write a setting. Secrets are encrypted at rest.
     */
    public static function put(string $key, $value): void
    {
        $stored = $value;
        if ($value !== null && $value !== '' && in_array($key, self::SECRET_KEYS, true)) {
            $stored = Crypt::encryptString($value);
        }

        static::query()->updateOrCreate(['key' => $key], ['value' => $stored]);
        Cache::forget("setting.$key");
    }

    /** True if a secret is stored (without revealing it). */
    public static function has(string $key): bool
    {
        return static::get($key) !== null;
    }
}
