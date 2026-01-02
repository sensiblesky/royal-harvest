<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Candidate extends Model
{
    //
    protected $guarded = [];

    public function programme(): BelongsTo
    {
        return $this->belongsTo(Programme::class);
    }
}
