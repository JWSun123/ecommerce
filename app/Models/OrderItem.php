<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrderItem extends Model
{
    use HasFactory;
    protected $table= 'order_items';
    protected $fillable = [
        'order_id',
        'entry_id',
        'price',
        'quantity',
    ];

    /**
     * Get the products that owns the OrderItem
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function entries(): BelongsTo
    {
        return $this->belongsTo(Entry::class, 'entry_id', 'id');
    }

}
