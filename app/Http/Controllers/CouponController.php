<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    function coupon(){
        $coupons = Coupon::all();
        return view('coupon.coupon',[
            'coupons' => $coupons,
        ]);
    }

    function add_coupon(Request $request){
        $request->validate([
            'coupon' => 'required',
            'type' => 'required',
            'amount' => 'required',
            'validity' => 'required',
            'limit' => 'required',
        ]);
        Coupon::insert([
            'coupon' => $request->coupon,
            'type' => $request->type,
            'amount' => $request->amount,
            'validity' => $request->validity,
            'limit' => $request->limit,
            'created_at' => Carbon::now(),
        ]);
        return back()->with('success', 'Coupon added successfully');
    }

    function coupon_status($id){
        $coupon = Coupon::find($id);
        if($coupon->status == 1){
            Coupon::find($id)->update([
                'status' => 0,
            ]);
        }
        else{
            Coupon::find($id)->update([
                'status' => 1,
            ]);
        }
        return back();
    }
}
