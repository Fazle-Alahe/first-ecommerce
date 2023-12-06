<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    function checkout(){
        $carts = Cart::where('customer_id', Auth::guard('customer')->id())->get();
        // return $carts;
        return view('frontend.checkout',[
            'carts' => $carts,
        ]);
    }
}
