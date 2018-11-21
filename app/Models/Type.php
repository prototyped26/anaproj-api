<?php
/**
 * Created by PhpStorm.
 * User: edlly
 * Date: 10/11/2018
 * Time: 04:25
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
// protected $timestamps = false;
    protected $table = 'type';
    //
    protected $fillable = [
        'label', 'description'
    ];
}
