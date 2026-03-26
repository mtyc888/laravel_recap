<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Project extends Model
{
    /** @use HasFactory<\Database\Factories\ProjectFactory> */
    use HasFactory;
    protected $fillable = ['client_id', 'name', 'description', 'status', 'hourly_rate', 'created_at', 'updated_at'];
    protected $table = 'projects';
    protected $cast = [
        'hourly_rate' => 'decimal:2'
    ];
    
    public function client(): BelongsTo{
        return $this->belongsTo(Client::class);
    } 

    public function timeEntries(): HasMany{
        return $this->hasMany(TimeEntry::class);
    }
}
