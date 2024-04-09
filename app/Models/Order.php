<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'address',
        'phone',
        'name_on_card',
        'discount',
        'discount_code',
        'total',
        'payment_gateway',
        'shipped',
    ];
}