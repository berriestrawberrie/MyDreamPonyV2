<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserItem extends Model
{
    //
    protected $fillable = [
        'qty',
        'itemid',
        'userid',

    ];
    protected $table = 'useritems';
}
