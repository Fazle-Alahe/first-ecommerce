<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\City;
use App\Models\Country;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    function checkout(){
        $countries = Country::all();
        $carts = Cart::where('customer_id', Auth::guard('customer')->id())->get();
        return view('frontend.checkout',[
            'carts' => $carts,
            'countries' => $countries,
        ]);
    }

    function getCity(Request $request){
        $str = '';
        $cities = City::where('country_id', $request->country_id)->get();
        foreach($cities as $city){
            $str .= '<option value="'.$city->id.'">'.$city->name.'</option>';
        }
        echo $str;
    }

    function order_store(Request $request){
        $request->validate([
            'fname'=>'required',
            'lname'=>'required',
            'country'=>'required',
            'city'=>'required',
            'zip'=>'required',
            'phone'=>'required',
            'address'=>'required',
            'delivery_charge'=>'required',
            'payment_method'=>'required',
        ]);

        if($request->payment_method == 1){
            $order_id = '#'.uniqid().'-'.Carbon::now()->format('d-m-Y');
            Order::insert([
                'order_id' => $order_id,
                'customer_id' => Auth::guard('customer')->id(),
                'total' => $request->total + $request->delivery_charge,
                'subtotal' => $request->total + $request->discount,
                'discount' => $request->discount,
                'delivery_charge' => $request->delivery_charge,
                'payment_method' => $request->payment_method,
                'created_at' => Carbon::now(),
            ]);
        }
        elseif($request->payment_method == 2){
            echo 'SSL';
        }
        elseif($request->payment_method == 3){
            echo 'STRIPE';
        }
        return back();
    }
}
