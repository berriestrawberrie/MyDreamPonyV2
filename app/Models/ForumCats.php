<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ForumCats extends Model
{
    //
    protected $fillable = [
        'id',
        'icon',
        'name',
        'desc'
    ];
    protected $table = 'category_tables';
    public $timestamps = false;
}
