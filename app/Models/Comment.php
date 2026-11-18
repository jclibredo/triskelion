<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $primaryKey = 'commentid';

    protected $fillable = [
        'message',
        'contentid',
        'author',
        'contenttype',
        'readstatus',
        'status',
    ];
}
