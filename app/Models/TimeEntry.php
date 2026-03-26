<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TimeEntry extends Model
{
    /** @use HasFactory<\Database\Factories\TimeEntryFactory> */
    use HasFactory;
    protected $fillable = ['project_id', 'invoice_id', 'description', 'started_at', 'ended_at', 'duration_minutes', 'billable', 'created_at', 'updated_at'];
    protected $table = 'time_entries';

    // casts are basically automatically convert them to their respective data type after retrieved from db, if not they will be string.
    protected $cast = [
        'started_at' => 'datetime',
        'ended_at' => 'datetime',
        'billable' => 'boolean'
    ];

    public function project():BelongsTo{
        return $this->belongsTo(Project::class);
    }

    public function invoice():BelongsTo{
        return $this->belongsTo(Invoice::class);
    }
}
