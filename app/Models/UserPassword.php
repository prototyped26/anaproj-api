<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserPassword extends Model
{
    public $timestamps = false;
    //
    protected $table = 'password_resets';
    protected $fillable = [
        'email', 'token', 'send_date', 'life_cycle', 'status'
    ];


}
