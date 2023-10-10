<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;
use Intervention\Image\Facades\Image;

class UserController extends Controller
{
    function user_update(){
        return view('admin.user.user');
    }
    function user_info_update(Request $request){
        $request->validate([
            'name'=>'required',
            'email'=>'required',
        ]);
        User::find(Auth::id())->update([
            'name'=>$request->name,
            'email'=>$request->email,

        ]);
        return back()->with('success', 'Profile updated successfully');
    }
    function user_password_update(Request $request){
        $request->validate([
            'current_password'=>'required',
            'new_password'=>[
                'required',
                Password::min(8)
                ->letters()
                ->mixedCase()
                ->numbers()
                ->symbols(),
                'confirmed',
            ],
            'confirm_password'=>'required',
        ],[
            
            'current_password.required'=>'Enter current password',
            'new_password.required'=>'Enter new password',
            'confirm_password.required'=>'Enter confirm password',
        ]);

        $user = User::find(Auth::id());
        if(Hash::check($request->current_password, $user->new_password)){
            User::find(Auth::id())->update([
                'password'=>bcrypt($request->new_password),
            ]);
            return back()->with('pass_success', 'Password updated successfully');
        }
        else{
            return back()->with('worng', 'Current password worng');
        }
    }
    function user_photo_update(Request $request){
        $request->validate([
            'photo' => 'required',
            'photo' => 'image',
        ]);

        if(Auth::user()->photo == null){
            $photo = $request->photo;
            $extension = $photo->extension();
            $file_name = Auth::id().'.'.$extension;
            Image::make($photo)->save(public_path('uploads/user/'.$file_name));

            User::find(Auth::id())->update([
                'photo' => $file_name,
            ]);
            return back()->with('photo_success', 'Photo updated successfully');
        }
        else{
            $current_img = public_path('uploads/user/'.Auth::user()->photo);
            unlink($current_img);

            $photo = $request->photo;
            $extension = $photo->extension();
            $file_name = Auth::id().'.'.$extension;
            Image::make($photo)->save(public_path('uploads/user/'.$file_name));

            User::find(Auth::id())->update([
                'photo' => $file_name,
            ]);
            return back()->with('photo_success', 'Photo updated successfully');
        }
    }
}
