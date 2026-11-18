<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Member extends Model
{
    protected $primaryKey = 'memberid';

    protected $fillable = [
        'firstname',
        'lastname',
        'middlename',
        'sex',
        'birthdate',
        'tcode',
        'tbirth',
        't6',
        'talexis',
        'tbatchname',
    ];

    public function getFullNameAttribute(): string
    {
        return "{$this->firstname} {$this->middlename} {$this->lastname}";
    }

    public function chapter(): BelongsTo
    {
        return $this->belongsTo(Chapter::class, 't6', 'chapid');
    }
}
