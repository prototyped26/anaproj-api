<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    //protected $timestamps = false;
    //
    protected $table = 'role';
    protected $fillable = [
        'label', 'code', 'description',
    ];


}
