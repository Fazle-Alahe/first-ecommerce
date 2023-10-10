<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Carbon\Carbon;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class SubCategoryController extends Controller
{
   function subcategory(){
        $categories = Category::all();
        return view('subcategory.index',[
            'categories' => $categories,
        ]);
    }

    function subcategory_store(Request $request){
        $request->validate([
            'category_id' => 'required',
            'subcategory_name' => 'required',
            // 'icon' => 'image',
        ]);

        if(Subcategory::where('category_id', $request->category_id)->where('subcategory_name',$request->subcategory_name)->exists()){
            return back()->with('exist', 'Subcategory name already exists in this Category');
        }
        else{
            $a = new Subcategory();
            $a->category_id = $request->category_id;
            $a->subcategory_name = $request->subcategory_name;
            $a->created_at = Carbon::now();
            if($request->hasFile('icon')){
                $icon = $request->icon;
                $extension = $icon->extension();
                $file_name = Str::lower( str_replace(' ', '-', $request->category_name)).'-'.random_int(50000, 60000).'.'.$extension;
                Image::make($icon)->save(public_path('uploads/subcategory/'.$file_name));
            }else{
                $file_name = null;
            }
            $a->icon = $file_name;
            $a->save();
            // if($request->icon == ''){
            //     Subcategory::insert([
            //         'category_id'=>$request->category_id,
            //         'subcategory_name'=>$request->subcategory_name,
            //         'created_at'=>Carbon::now(),
            //     ]);
            //     return back()->with('success', 'Subcategory added successfully');
            // }
            // else{
                
            // $icon = $request->icon;
            // $extension = $icon->extension();
            // $file_name = Str::lower( str_replace(' ', '-', $request->category_name)).'-'.random_int(50000, 60000).'.'.$extension;
            // Image::make($icon)->save(public_path('uploads/subcategory/'.$file_name));
            // Subcategory::insert([
            //     'category_id'=>$request->category_id,
            //     'subcategory_name'=>$request->subcategory_name,
            //     'icon'=>$file_name,
            //     'created_at'=>Carbon::now(),
            // ]);
        }
        return back()->with('success', 'Subcategory added successfully');
    }

    function subcategory_edit($id){
        $categories = Category::all();
        $subcategories = Subcategory::find($id);
        return view('subcategory.edit',[
            'categories' => $categories,
            'subcategories' => $subcategories,
        ]);
    }

    function subcategory_update(Request $request, $id){
        $request->validate([
            'category_id' => 'required',
            'subcategory_name' => 'required',
            'icon' => 'image',
        ]);
    
        if(!$request->hasFile('icon') == ' '){

            Subcategory::find($id)->update([
                'category_id'=>$request->category_id,
                'subcategory_name'=>$request->subcategory_name,
                'created_at'=>Carbon::now(),
            ]);
            return back()->with('success', 'Subcategory updated successfully');
        }
        else{
            
            $subcate_id = Subcategory::find($id);
            $cate_icon = public_path('uploads/subcategory/'.$subcate_id->icon);
            unlink($cate_icon);
            
            $icon = $request->icon;
            $extension = $icon->extension();
            $file_name = Str::lower( str_replace(' ', '-', $request->category_name)).'-'.random_int(50000, 60000).'.'.$extension;
            Image::make($icon)->save(public_path('uploads/subcategory/'.$file_name));
            Subcategory::find($id)->update([
                'category_id'=>$request->category_id,
                'subcategory_name'=>$request->subcategory_name,
                'icon'=>$file_name,
                'created_at'=>Carbon::now(),
            ]);
            return back()->with('success', 'Subcategory updated successfully');
        }
    }

    function subcategory_delete($id){
            $subcate_id = Subcategory::find($id);
            $cate_icon = public_path('uploads/subcategory/'.$subcate_id->icon);
            unlink($cate_icon);

            Subcategory::find($id)->delete();
            return back()->with('delete', 'Subcategory deleted!!');
    }
}
