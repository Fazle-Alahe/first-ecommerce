<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    function banner(){
        $categories = Category::all();
        $banners = Banner::all();
        return view('banner.banner',[
            'categories' => $categories,
            'banners' => $banners,
        ]);
    }

    function banner_store(Request $request){
        $request->validate([
            'title' => 'required',
            'link' => 'required',
            'image' => 'required|image',
        ]);

        
        $image = $request->image;
        $extension = $image->extension();
        $file_name = Str::lower( str_replace(' ', '-', 'image')).'-'.random_int(50000, 60000).'.'.$extension;
        Image::make($image)->save(public_path('uploads/banner/'.$file_name));
        Banner::insert([
            'title' => $request->title,
            'link' => $request->link,
            'image'=>$file_name,
            'created_at'=>Carbon::now(),
        ]);
        return back()->with('success', 'Banner updated successfully');
    }

    function banner_delete($id){
        $image = Banner::find($id);
        $image_delete = public_path('uploads/banner/'.$image->image);
        unlink($image_delete);

        Banner::find($id)->delete();
        return back()->with('delete', 'Banner deleted!!');
    }
}
