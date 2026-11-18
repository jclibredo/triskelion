<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Area extends Model
{
    protected $primaryKey = 'areaid';
    protected $fillable = ['areaname', 'address', 'councilid', 'status'];
    public function chapters(): HasMany
    {
        return $this->hasMany(Chapter::class, 'areaid', 'areaid');
    }

    public function officers(): HasMany
    {
        return $this->hasMany(Officer::class, 'areaid', 'areaid');
    }
    public function council()
    {
        return $this->belongsTo(Council::class, 'councilid', 'councilid');
    }
}
