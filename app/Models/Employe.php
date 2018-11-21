<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employe extends Model
{
    //
    // protected $timestamps = false;
    protected $table = 'employe';
    //
    protected $fillable = [
        'nom', 'prenom', 'date_naiss', 'lieu_naiss', 'tel', 'email', 'residence', 'photo', 'profession_id'
    ];

    public function profession() {
        return $this->belongsTo(Profession::class);
    }

}
