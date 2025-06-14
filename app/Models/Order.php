<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

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
        'total_price' => 'decimal:2',
    ];

    protected function cartDetails(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => is_string($value) ? json_decode($value, true) : $value,
        );
    }
}
