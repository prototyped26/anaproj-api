<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    // protected $timestamps = false;
    protected $table = 'event';
    //
    protected $fillable = [
        'title', 'place', 'color', 'color_secondary', 'start', 'end'
    ];

    public function option() {
        return $this->belongsTo(Option::class);
    }
}
