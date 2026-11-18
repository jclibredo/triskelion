<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    protected $primaryKey = 'chatid';

    protected $fillable = [
        'message',
        'author',
        'recipient',
        'readstatus',
    ];

    protected $casts = [
        'readstatus' => 'boolean',
    ];
}
