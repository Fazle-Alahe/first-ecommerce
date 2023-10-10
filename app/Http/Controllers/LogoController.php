<?php

namespace App\Http\Controllers;

use App\Models\Logo;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Illuminate\Http\Request;

class LogoController extends Controller
{
    function logo(){
        $logo = Logo::first();
        return view('logo.logo',[
            'logo'=>$logo,
        ]);
    }

    // function logo_store(Request $request){
    //     $request->validate([
    //         'logo'=>'required',
    //     ]);

        
    //     $logo = Logo::first();
    //     $logo_delete = public_path('uploads/logo/'.$logo->logo);
    //     unlink($logo_delete);
    //     Logo::first()->delete();

    //     $logo = $request->logo;
    //     $extension = $logo->extension();
    //     $file_name = Str::lower( str_replace(' ', '-', 'logo')).'-'.random_int(50000, 60000).'.'.$extension;
    //     // return $file_name;
    //     Image::make($logo)->save(public_path('uploads/logo/'.$file_name));
    //     Logo::insert([
    //         'logo'=>$file_name,
    //         'created_at'=>Carbon::now(),
    //     ]);
    //     return back()->with('success', 'Logo updated successfully');
    // }
}
