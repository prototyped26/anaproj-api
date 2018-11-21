<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    // protected $timestamps = false;
    protected $table = 'client';
    //
    protected $fillable = [
        'nom', 'prenom','tel','email', 'adresse', 'compte',
    ];

}
