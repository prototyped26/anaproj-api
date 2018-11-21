<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    protected $table = 'option';
    //
    protected $fillable = [
        'label', 'desc', 'filiere_id'
    ];

    public function filiere() {
        return $this->belongsTo(Commentaire::class);
    }
}
