<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Programme extends Model
{

    protected $guarded = [];
    //
    public function candidates(): HasMany
    {
        return $this->hasMany(Candidate::class);
    }
      public static function clearAll()
    {
        $programmes = self::with('candidates')->get();
        
        foreach ($programmes as $programme) {
            $programme->candidates()->update(['programme_id' => null]);
            // $programme->candidates()->delete();
            
            $programme->delete();
        }
        
        if (app('db')->connection()->getDriverName() === 'mysql') {
            app('db')->statement('ALTER TABLE programmes AUTO_INCREMENT = 1');
        }
    }


}
