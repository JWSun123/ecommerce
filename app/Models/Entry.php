<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entry extends Model
{
    use HasFactory;
    protected $table = 'entries';
    protected $fillable = [
        'product_id',
        'size_id',
        'color_id',
        'quantity',
    ];

    public function size()
    {
        return $this->belongsTo(Size::class,'size_id','id');
    }

    public function color()
    {
        return $this->belongsTo(Color::class,'color_id','id');
    }

    public function product(){
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
}
