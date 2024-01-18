<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderProducts extends Model
{
    use HasFactory;

    protected $guarded =['id'];

    function rel_to_customer(){
        return $this->belongsTo(Customer::class, 'customer_id');
    }
    function rel_to_product(){
        return $this->belongsTo(Product::class, 'product_id');
    }
    function orders(){
        return $this->hasOne(Order::class, 'order_id');
    }
    
}
