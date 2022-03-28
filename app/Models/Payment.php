<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    protected $table = 'payment';
    protected $fillable = [
        'user_id',
        'payment_method',
        'user_name',
        'card_number',
        'expiry_date',
        'cvv',
    ];
}
