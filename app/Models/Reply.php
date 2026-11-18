<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    protected $primaryKey = 'repid';

    protected $fillable = [
        'messageeeid',
        'messagetype',
        'message',
        'readstatus',
    ];

    protected $casts = [
        'readstatus' => 'boolean',
    ];
}
