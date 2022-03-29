<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'products';
    protected $fillable = [
        'category_id',
        'name',
        'brand',
        'description',
        'price',
        'image',
        'status',
        'meta_title',
        'meta_keywords',
        'meta_descrip',
    ];

    public function category(){
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
    
    public function entry(){
        return $this->hasMany(Entry::class);
    }
}


