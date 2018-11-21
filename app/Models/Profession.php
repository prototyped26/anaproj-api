<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profession extends Model
{
    // protected $timestamps = false;
    protected $table = 'profession';
    //
    protected $fillable = [
        'label', 'description', 'code'
    ];
}
