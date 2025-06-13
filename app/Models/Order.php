<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_number',
        'cart_details',
        'total_price',
        'status',
        'whatsapp_message'
    ];

    protected $casts = [
        'cart_details' => 'array',
        'total_price' => 'decimal:2',
    ];
}
