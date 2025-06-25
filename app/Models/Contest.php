<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contest extends Model
{
    //
    protected $fillable = [
        'userid',
        'runtime',
        'splits250',
        'updated_at',
        'splits500',
        'splits750',
        'splits1000',
        'unlimited1',
        'unlimited2',
        'unlimited3',
        'unlimited4',
        'baby1',
        'baby2',
        'baby3',
        'baby4',
        'photo',
        'contest_type'

    ];
    protected $table = 'contests';
}
