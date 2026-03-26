<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Invoice extends Model
{
    /** @use HasFactory<\Database\Factories\InvoiceFactory> */
    use HasFactory;
    protected $fillable = [
        'user_id',
        'client_id',
        'invoice_number',
        'status',
        'issue_date',
        'due_date',
        'sub_total',
        'tax_amount',
        'total',
        'notes',
        'send_at',
        'paid_at',
        'deleted_at',
        'created_at','updated_at'
        ];
    protected $cast = [
        'issue_date' => 'date',
        'due_date' => 'date',
        'sub_total' => 'decimal:2',
        'tax_amount' => 'decimal:2',
        'total' => 'decimal:2',
        'tax_rate' => 'decimal:2',
        'send_at' => 'datetime',
        'paid_at' => 'datetime',
    ];

    public function client():BelongsTo{
        return $this->belongsTo(Client::class);
    }

    public function user():BelongsTo{
        return $this->belongsTo(User::class);
    }

    public function lineItems(): HasMany{
        return $this->hasMany(LineItem::class);
    }

    public function payments(): HasMany{
        return $this->hasMany(Payment::class);
    }

    public function timeEntries(): HasMany{
        return $this->hasMany(TimeEntry::class);
    }

    //helper
    public function recalculateTotal(): void{
        $this->subtotal = $this->lineItems()->sum('amount');
        $this->tax_amount = $this->subtotal * ($this->tax_rate/100);
        $this->total = $this->subtotal + $this->tax_amount;
        $this->save();
    }
}
