<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //
    protected $table = 'post';
    //
    protected $fillable = [
        'titre', 'message','user_id', 'categorie_id'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function categorie() {
        return $this->belongsTo(Categorie::class);
    }

}
