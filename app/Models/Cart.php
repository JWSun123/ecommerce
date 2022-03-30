<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    protected $table = 'carts';
    protected $fillable = [
        'user_id',
        'entry_id',
        'prod_qty',
    ];

    public function entry()
    {
        return $this->belongsTo(Entry::class,'entry_id','id');
    }
}
