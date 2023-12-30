<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderProducts;
use App\Models\Shipping;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Auth;
use PDF;

class CustomerController extends Controller
{
    function customer_profile(){
        return view('frontend.customer.profile');
    }

    function customer_logout(){
        Auth::guard('customer')->logout();
        return redirect()->route('index')->with('logout', 'You are logged out!');
    }

    function customer_profile_update(Request $request){
        $request->validate([
            'fname' => 'required',
        ]);

        if($request->password == ''){
            if($request->image == ''){
                Customer::find(Auth::guard('customer')->id())->update([
                    'fname' => $request->fname,
                    'lname' => $request->lname,
                    'phone' => $request->phone,
                    'zip' => $request->zip,
                    'address' => $request->address,
                    'updated_at' => Carbon::now(),
                ]);
                return back();
            }
            else{
                $current_img = public_path('uploads/customer/'. Auth::guard('customer')->user()->photo);
                unlink($current_img);

                $img = $request->image;
                $extension = $img->extension();
                $filename = Auth::guard('customer')->id().'.'.$extension;
                Image::make($img)->save(public_path('uploads/customer/'.$filename));

                Customer::find(Auth::guard('customer')->id())->update([
                    'fname' => $request->fname,
                    'lname' => $request->lname,
                    'phone' => $request->phone,
                    'zip' => $request->zip,
                    'address' => $request->address,
                    'photo' => $filename,
                    'updated_at' => Carbon::now(),
                ]);
                return back();
            }
        }
        else{
            if($request->image == ''){
                Customer::find(Auth::guard('customer')->id())->update([
                    'fname' => $request->fname,
                    'lname' => $request->lname,
                    'password' => bcrypt($request->password),
                    'phone' => $request->phone,
                    'zip' => $request->zip,
                    'address' => $request->address,
                    'updated_at' => Carbon::now(),
                ]);
                return back();
            }
            else{
                $current_img = public_path('uploads/customer/'. Auth::guard('customer')->user()->photo);
                unlink($current_img);
                
                $img = $request->image;
                $extension = $img->extension();
                $filename = Auth::guard('customer')->id().'.'.$extension;
                Image::make($img)->save(public_path('uploads/customer/'.$filename));

                Customer::find(Auth::guard('customer')->id())->update([
                    'fname' => $request->fname,
                    'lname' => $request->lname,
                    'password' => bcrypt($request->password),
                    'phone' => $request->phone,
                    'zip' => $request->zip,
                    'address' => $request->address,
                    'photo' => $filename,
                    'updated_at' => Carbon::now(),
                ]);
                return back();
            }
        }
    }

    function my_orders(){
        $orders = Order::where('customer_id', Auth::guard('customer')->id())->with('rel_to_order_products')->latest()->get();
        // return $orders;
        return view('frontend.customer.my_orders',[
            'orders' => $orders,
            // 'order_product' => $order_product,
        ]);
    }

    function download_invoice($id){
        $orders = Order::find($id);

        $pdf = PDF::loadView('frontend.customer.download_invoice',[
            'order_id' => $orders->order_id,
        ]);
    
        return $pdf->download('myorders.pdf');
    }
}
