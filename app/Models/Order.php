<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    function rel_to_shipping(){
        return $this->belongsTo(Shipping::class, 'order_id');
    }
    function rel_to_order_products(){
        return $this->belongsTo(OrderProducts::class, 'customer_id');
    }
}
