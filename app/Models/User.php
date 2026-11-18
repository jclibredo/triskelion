<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable([
    'name',
    'email',
    'password',
    'memberid',
    'mobilenumber',
    'accountType',
    'typeid',
    'status'
])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'status' => 'boolean',
        ];
    }

    public function member(): BelongsTo
    {
        return $this->belongsTo(Member::class, 'memberid', 'memberid');
    }

    /**
     * Dynamic relationship for Chapter when accountType is 'CHAPTER'
     */
    public function chapter(): BelongsTo
    {
        return $this->belongsTo(Chapter::class, 'typeid', 'chapid');
    }

    /**
     * Dynamic relationship for Area when accountType is 'AREA'
     */
    public function area(): BelongsTo
    {
        return $this->belongsTo(Area::class, 'typeid', 'areaid');
    }

    /**
     * Dynamic relationship for Council when accountType is 'COUNCIL'
     */
    public function council(): BelongsTo
    {
        return $this->belongsTo(Council::class, 'typeid', 'councilid');
    }

    /**
     * Generic helper accessor to get the related entity object regardless of type.
     */
    public function getAssociatedEntityAttribute()
    {
        return match ($this->accountType) {
            'CHAPTER' => $this->chapter,
            'AREA' => $this->area,
            'COUNCIL' => $this->council,
            default => null,
        };
    }
}
