<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ForumTops extends Model
{
    //
    protected $fillable = [
        'id',
        'subject',
        'date',
        'category',
        'topic_by',
        'user_name',
        'update_date',
        'post_count'
    ];
    protected $table = 'topic_tables';
    public $timestamps = false;
}
