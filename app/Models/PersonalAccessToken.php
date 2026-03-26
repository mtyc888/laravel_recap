<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PersonalAccessToken extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'token',
        'expires_at',
    ];
    protected $table = 'personal_access_tokens';

    public function user(): BelongsTo{
        return $this->belongsTo(User::class);
    }

    public function isExpired():bool{
        return $this->expires_at && $this->expires_at->isPast();
    }
}
