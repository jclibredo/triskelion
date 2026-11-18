<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Rank extends Model
{
    protected $primaryKey = 'rankid';
    protected $fillable = ['rankname', 'rankdetails', 'status'];

    public function officers(): HasMany
    {
        return $this->hasMany(Officer::class, 'rankid', 'rankid');
    }
}
