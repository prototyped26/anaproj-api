<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Produit extends Model
{
    //protected $timestamps = false;
    protected $table = 'produit';
    //
    protected $fillable = [
        'label', 'description'
    ];


    /*public function user() {
        return $this->belongsTo(User::class, 'author');
    }

    public function elements() {
        return $this->hasMany(Post::class, 'content', 'id');
    }
    public function likes() {
        return $this->hasMany(Like::class, 'content', 'id');
    }
    public function comments() {
        return $this->hasMany(Commentaire::class, 'content', 'id');
    }
    public function follows() {
        return $this->hasMany(Event::class, 'content', 'id');
    }*/
}
