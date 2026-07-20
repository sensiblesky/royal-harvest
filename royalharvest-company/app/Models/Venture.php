<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Venture extends Model
{
    protected $guarded = [];

    public function isComingSoon(): bool
    {
        return $this->status === 'coming_soon';
    }
}
