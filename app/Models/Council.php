<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Council extends Model
{
    protected $primaryKey = 'councilid';
    protected $fillable = ['councilname', 'catid', 'counciladdress', 'status'];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'catid', 'catid');
    }

    public function chapters(): HasMany
    {
        return $this->hasMany(Chapter::class, 'councilid', 'councilid');
    }

    public function officers(): HasMany
    {
        return $this->hasMany(Officer::class, 'councilid', 'councilid');
    }

    public function areas(): HasMany
    {
        return $this->hasMany(Area::class, 'councilid', 'councilid');
    }
}
