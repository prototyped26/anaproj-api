<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Commentaire extends Model
{
    // protected $timestamps = false;
    protected $table = 'commentaire';
    //
    protected $fillable = [
        'label', 'user_id', 'post_id'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function post() {
        return $this->hasMany(Post::class);
    }
}
