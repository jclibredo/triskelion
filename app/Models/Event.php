<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $primaryKey = 'eventid';

    protected $fillable = [
        'eventdate',
        'eventname',
        'eventdetails',
        'eventphotos',
        'author',
        'status',
    ];

    protected $casts = [
        'eventphotos' => 'array', // or 'eventphotos' => 'array'
        'status' => 'boolean',
    ];
}
