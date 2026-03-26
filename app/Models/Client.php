<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Support\Str;

class Client extends Model
{
    /** @use HasFactory<\Database\Factories\ClientFactory> */
    use HasFactory;
    protected $fillable = ['user_id','uuid','name','email','company','phone','address','created_at','updated_at'];
    protected $table = 'clients';

    // we need to automatically generate uuid for every new clients right before it gets saved to the db
    // booted() is a special method Laravel calls once when the model class is first used.
    protected static function booted():void {
        // static::creating() registers a callback that fires specifically during the "creating" event, the moment after save() or create() is called
        static::creating(function (Client $client){
            $client->uuid = $client->uuid ?: (string) Str::uuid();
        });
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function projects(): HasMany
    {
        return $this->hasMany(Project::class);
    }

    public function invoices(): HasMany
    {
        return $this->hasMany(Invoice::class);
    }

    // HasManyThrough = client -> projects -> time entries
    public function timeEntries(): HasManyThrough
    {
        return $this->hasManyThrough(TimeEntry::class, Project::class);
    }
}
