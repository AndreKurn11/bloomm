<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Order extends Model {
    protected $fillable = [
        'order_id', 'customer_name', 'customer_phone', 'notes',
        'items', 'subtotal', 'tax', 'total', 'payment_method', 'status'
    ];

    protected $casts = ['items' => 'array'];
}