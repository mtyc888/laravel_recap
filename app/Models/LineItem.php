<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LineItem extends Model
{
    /** @use HasFactory<\Database\Factories\LineItemFactory> */
    use HasFactory;
    protected $fillable = [
        'invoice_id',
        'description',
        'quantity',
        'unit_price',
        'amount',
        'created_at',
        'updated_at'
    ];
    protected $cast = [
        'quantity' => 'decimal:2',
        'unit_price' => 'decimal:2',
        'amount' => 'decimal:2'
    ];
    public function invoice(): BelongsTo{
        return $this->belongsTo(Invoice::class);
    }
    // we need to auto calculate the amount, recalculate invoice total when line items changes
    protected static function booted():void{
        static::saving(function(LineItem $item){
            $item->amount = $item->quantity * $item->unit_price;
        });

        static::saved(function (LineItem $item){
            $item->invoice()->recalculateTotal();
        });

        static::deleted(function (LineItem $item){
            $item->invoice()->recalculateTotal();
        });
    }
}
