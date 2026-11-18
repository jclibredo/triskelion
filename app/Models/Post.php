<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $primaryKey = 'postid';

    protected $fillable = [
        'postname',
        'postdetails',
        'postphotos',
        'author',
        'status',
    ];
    protected $casts = [
        'postphotos' => 'array', // or 'eventphotos' => 'array'
        'status' => 'boolean',
    ];
}
