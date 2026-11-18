<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Officer extends Model
{
    protected $primaryKey = 'officerid';
    protected $fillable = ['rankid', 'memberid', 'chapid', 'areaid', 'councilid', 'status'];
    public function rank(): BelongsTo
    {
        return $this->belongsTo(Rank::class, 'rankid', 'rankid');
    }

    public function member(): BelongsTo
    {
        return $this->belongsTo(Member::class, 'memberid', 'memberid');
    }

    public function chapter(): BelongsTo
    {
        return $this->belongsTo(Chapter::class, 'chapid', 'chapid');
    }

    public function area(): BelongsTo
    {
        return $this->belongsTo(Area::class, 'areaid', 'areaid');
    }

    public function council(): BelongsTo
    {
        return $this->belongsTo(Council::class, 'councilid', 'councilid');
    }
}
