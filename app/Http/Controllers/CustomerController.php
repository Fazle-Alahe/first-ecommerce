<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\CustomerEmailVerify;
use App\Models\Order;
use App\Models\OrderProducts;
use App\Models\Shipping;
use App\Notifications\EmailVerifyNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
// use Barryvdh\DomPDF\PDF;
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

    function customer_email_verify($token){
        $verify_info = CustomerEmailVerify::where('token', $token)->first();

        if(CustomerEmailVerify::where('token', $token)->exists()){
            Customer::find($verify_info->customer_id)->update([
                'email_verified_at' => Carbon::now(),
            ]);
    
            CustomerEmailVerify::where('token', $token)->delete();
    
            return redirect()->route('customer.login')->with('verify', 'Email verified success!');
        }
        else{
            abort('404');
        }

    }

    function resend_verification_link(){
        return view('frontend.customer.email_verify');
    }

    function verification_link_sent(Request $request){
        $request->validate([
            'email' => 'required',
        ]);

        $customer = Customer::where('email', $request->email)->first();
        if(Customer::where('email', $request->email)->exists()){
            CustomerEmailVerify::where('customer_id', $customer->id)->delete();
            $info = CustomerEmailVerify::create([
                'customer_id' => $customer->id,
                'token' => uniqid(),
                'created_at' => Carbon::now(),
            ]);

            Notification::send($customer, new EmailVerifyNotification($info));

            return back()->with('success', 'We have sent you a verification link,Please verify your email.');
        }
        else{
            return back('exist', 'Email does not exist');
        }
    }
}
