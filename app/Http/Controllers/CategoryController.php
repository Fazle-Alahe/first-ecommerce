<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Subcategory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class CategoryController extends Controller
{
    function category(){
        $categories = Category::all();
        return view('category.category', compact('categories'));
    }

    function category_store(Request $request){
        $request->validate([
            'category_name'=>'required|unique:categories',
            'icon'=>'required',
            'icon'=>'image',
        ]);
        
        $icon = $request->icon;
        $extension = $icon->extension();
        $file_name = Str::lower( str_replace(' ', '-', $request->category_name)).'-'.random_int(50000, 60000).'.'.$extension;
        Image::make($icon)->save(public_path('uploads/category/'.$file_name));
        Category::insert([
            'category_name'=>$request->category_name,
            'icon'=>$file_name,
            'created_at'=>Carbon::now(),
        ]);
        return back()->with('success', 'Category added successfully');
    }

    function category_soft_delete($category_id){
        Category::find($category_id)->delete();
        return back()->with('soft_delete', 'Category moved to trash');
    }

    function category_trash(){
        $categories = Category::onlyTrashed()->get();
        return view('category.trash',[
            'categories'=>$categories,
        ]);
    }

    function category_restore($category_id){
        Category::onlyTrashed()->find($category_id)->restore();
        return back()->with('category_restore', 'Category restored');
    }

    function category_permanent_delete($category_id){
        $cate_id = Category::onlyTrashed()->find($category_id);
        $cate_icon = public_path('uploads/category/'.$cate_id->icon);
        unlink($cate_icon);

        Category::onlyTrashed()->find($category_id)->forceDelete();

        // Subcategory::where('category_id', $category_id)->update([
        //     'category_id'=> 3,
        // ]);
        return back()->with('pDelete', 'Category deleted permanently');
    }

    function category_edit($category_id){
        $categories = Category::find($category_id);
        return view('category.edit',[
            'categories'=>$categories,
        ]);
    }

    function category_update(Request $request,$category_id){
        $request->validate([
            'category_name'=>'required',
        ]);
        if(!$request->hasFile('icon')){
            Category::find($category_id)->update([
                'category_name'=>$request->category_name,
            ]);
            
            return back()->with('success', 'Category updated successfully');
        }
        else{    
            $cate_id = Category::find($category_id);
            $cate_icon = public_path('uploads/category/'.$cate_id->icon);
            unlink($cate_icon);
            
            $icon = $request->icon;
            $extension = $icon->extension();
            $file_name = Str::lower( str_replace(' ', '-', $request->category_name)).'-'.random_int(50000, 60000).'.'.$extension;
            Image::make($icon)->save(public_path('uploads/category/'.$file_name));
            Category::find($category_id)->update([
                'category_name'=>$request->category_name,
                'icon'=>$file_name,
            ]);
            return back()->with('success', 'Category updated successfully');
        }
    }

    function checked_delete(Request $request){
        foreach($request->category_id as $category){
            Category::find($category)->delete();
        }
        return back()->with('soft_delete', 'Category moved to trash');
    }

    function checked_restore(Request $request){

        if($request->btn == 1){
            foreach($request->category_id as $category){
                Category::onlyTrashed()->find($category)->restore();
            }
            return back()->with('category_restore', 'Category restored');
        }
        elseif($request->btn == 2){
            foreach($request->category_id as $category){
            $cate_id = Category::onlyTrashed()->find($category);
            $cate_icon = public_path('uploads/category/'.$cate_id->icon);
            unlink($cate_icon);

            Category::onlyTrashed()->find($category)->forceDelete();
            }
        }
        return back()->with('pDelete', 'Category deleted permanently');
    }
}
