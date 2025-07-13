<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ForumPosts extends Model
{
    //
    protected $fillable = [
        'id',
        'post_content',
        'post_date',
        'post_topic',
        'post_by',
        'post_user_name',
        'update_date',
        'post_category',
        'bbc_content'
    ];
    protected $table = 'post_tables';
    public $timestamps = false;
}
