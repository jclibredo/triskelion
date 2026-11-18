<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    protected $primaryKey = 'catid';
    protected $fillable = ['category', 'description', 'name', 'status'];
    
    public function councils(): HasMany
    {
        return $this->hasMany(Council::class, 'catid', 'catid');
    }

    public function chapters(): HasMany
    {
        return $this->hasMany(Chapter::class, 'catid', 'catid');
    }
}
