<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    function brand(){
        $brands = Brand::all();
        return view('brand.brand',[
            'brands'=>$brands,
        ]);
    }

    function brand_store(Request $request){
        $request->validate([
            'brand_name'=>'required|unique:brands',
            'logo'=>'required',
            'logo'=>'image',
        ]);

        
        $logo = $request->logo;
        $extension = $logo->extension();
        $file_name = Str::lower( str_replace(' ', '-', $request->brand_name)).'-'.random_int(50000, 60000).'.'.$extension;
        Image::make($logo)->save(public_path('uploads/brand/'.$file_name));
        Brand::insert([
            'brand_name'=>$request->brand_name,
            'logo'=>$file_name,
            'created_at'=>Carbon::now(),
        ]);
        return back()->with('success', 'Brand added successfully');
    }


    function brand_edit($id){
        $brands = Brand::find($id);
        return view('brand.edit', [
            'brands'=>$brands,
        ]);
    }

    function brand_update(Request $request, $id){
        $request->validate([
            // |unique:brands
            'brand_name'=>'required', 
            'logo'=>'image',
        ]);
        if(!$request->hasFile('logo')){
            Brand::find($id)->update([
                'brand_name'=>$request->brand_name,
            ]);
        }
        else{  
            $logo = Brand::find($id);
            $logo_delete = public_path('uploads/brand/'.$logo->logo);
            unlink($logo_delete);
                
            $logo = $request->logo;
            $extension = $logo->extension();
            $file_name = Str::lower( str_replace(' ', '-', $request->brand_name)).'-'.random_int(50000, 60000).'.'.$extension;
            Image::make($logo)->save(public_path('uploads/brand/'.$file_name));
            Brand::find($id)->insert([
                'brand_name'=>$request->brand_name,
                'logo'=>$file_name,
                'created_at'=>Carbon::now(),
            ]);
        }
        return back()->with('success', 'Brand updated successfully');
    }

    function brand_delete($id){
        $logo = Brand::find($id);
        $logo_delete = public_path('uploads/brand/'.$logo->logo);
        unlink($logo_delete);

        Brand::find($id)->delete();
        return back()->with('delete', 'Brand deleted!!');
    }
}
