<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\CustomerEmailVerify;
use App\Notifications\EmailVerifyNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Illuminate\Validation\Rules\Password;

class CustomerAuthController extends Controller
{
    function customer_login(){
        return view('frontend.customer.customer_login');
    } 
     
    function customer_register(){
        return view('frontend.customer.customer_register');
    }

    function customer_store(Request $request){
        $request->validate([
            'fname' => 'required',
            'email' => 'required|unique:customers',
            'password' => [
                'required',
                'confirmed',
                Password::min(8)
                ->letters()
                ->mixedCase()
                ->numbers()
                ->symbols()
            ],
            'password_confirmation' => 'required',
        ]);

        $customer_info = Customer::create([
            'fname' => $request->fname,
            'lname' => $request->lname,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'created_at' => Carbon::now(),
        ]);

        CustomerEmailVerify::where('customer_id', $customer_info->id)->delete();
        $info = CustomerEmailVerify::create([
            'customer_id' => $customer_info->id,
            'token' => uniqid(),
            'created_at' => Carbon::now(),
        ]);

        Notification::send($customer_info, new EmailVerifyNotification($info));

        return back()->with('success', 'Customer Registered Successfully,Please verify your email.');
    }

    function customer_logged(Request $request){
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        if(Customer::where('email', $request->email)->exists()){
            if(Auth::guard('customer')->attempt(['email' => $request->email, 'password' => $request->password])){
                if(Auth::guard('customer')->user()->email_verified_at == null){
                    Auth::guard('customer')->logout();
                    return back()->with('email_verify', 'Please verify your email');
                }
                else{
                    return redirect()->route('index');
                }
            }
            else{
                return back()->with('wrong', 'Worng Credential.');
            }
        }
        else{
            return back()->with('exist', 'Email does not exists.');
        }
    }
}
