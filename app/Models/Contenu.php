<?php
/**
 * Created by PhpStorm.
 * User: edlly
 * Date: 10/11/2018
 * Time: 04:26
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contenu extends  Model
{
    protected $table = 'contenu';
    //
    protected $fillable = [
        'titre', 'titre_en', 'lien', 'description', 'content', 'content_en', 'image', 'active', 'type_id'
    ];


    public function type() {
        return $this->belongsTo(Type::class);
    }
}
