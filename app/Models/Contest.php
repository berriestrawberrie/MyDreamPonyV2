<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contest extends Model
{
    //
    protected $fillable = [
        'userid',
        'token',
        'title',
        'runtime',
        'contest_attribute',
        'fee',
        'maxlimit',
        'splits250',
        'updated_at',
        'splits500',
        'splits750',
        'splits1000',
        'unlimit1',
        'unlimit2',
        'unlimit3',
        'unlimit4',
        'baby1',
        'baby2',
        'baby3',
        'baby4',
        'banner',
        'contest_type'

    ];
    protected $table = 'contests';
}
