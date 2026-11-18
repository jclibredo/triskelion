<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Chapter extends Model
{
    protected $primaryKey = 'chapid';
    protected $fillable = ['chaptername', 'addressid', 'areaid', 'councilid', 'catid', 'status'];

    public function area(): BelongsTo
    {
        return $this->belongsTo(Area::class, 'areaid', 'areaid');
    }

    public function council(): BelongsTo
    {
        return $this->belongsTo(Council::class, 'councilid', 'councilid');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'catid', 'catid');
    }

    public function officers(): HasMany
    {
        return $this->hasMany(Officer::class, 'chapid', 'chapid');
    }
}
