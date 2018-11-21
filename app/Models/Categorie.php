<?php
/**
 * Created by PhpStorm.
 * User: edlly
 * Date: 08/11/2018
 * Time: 00:02
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{

    // protected $timestamps = false;
    protected $table = 'categorie';
    //
    protected $fillable = [
        'label', 'couleur'
    ];

}
