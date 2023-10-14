<?php

namespace App\Http\Controllers;

use App\Models\subscriber;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    function dashboard(){
        return view('dashboard');
    }
    function user_list(){
        $users = User::where('id', '!=', Auth::id())->get();
        return view('admin.user.user_list', compact('users'));
    }
    function user_delete($user_id){
        User::find($user_id)->delete();
        return back()->with('delete', 'Photo delete successfully');
    }
    function add_user(Request $request){
        $request->validate([
            'name'=>'required',
            'email'=>'required',
            'password'=>'required',
            'password'=>Password::min(8)
            ->letters()
            ->mixedCase()
            ->numbers()
            ->symbols(),
            'confirm_password'=>'required',
        ]);
        if($request->password != $request->confirm_password){
            return back()->with('wrong', 'Password and Confirm password does not match');
        }
        User::insert([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>bcrypt($request->password),
        ]);
        return back()->with('add_success', 'New user added successfully');
    }
    

    function subscriber_store(Request $request){
        subscriber::insert([
            'customer_id' => 1,
            'email' => $request->email,
            'created_at' => Carbon::now(),
        ]);
        return back();
    }

    function subscriber(){
        $subscibers = subscriber::all();
        return view('subscriber.subscriber',[
            'subscibers' => $subscibers,
        ]);
    }
}
