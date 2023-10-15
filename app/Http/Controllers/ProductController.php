<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductGallery;
use App\Models\Subcategory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class ProductController extends Controller
{
    function add_product(){
        $categories = Category::all();
        $subcategories = Subcategory::all();
        $brands = Brand::all();
        return view('product.index',[
            'categories'=>$categories,
            'subcategories'=>$subcategories,
            'brands'=>$brands,
        ]);
    }


        
    function getsubcategory(Request $request){
        $str = '<option value="">Select Subcategory</option>';
        $subcategories = Subcategory::where('category_id', $request->category_id)->get();
        foreach($subcategories as $subcategory){
            $str .= '<option value="'.$subcategory->id.'">'.$subcategory->subcategory_name.'</option>';
        }
        echo $str;
    }

    function product_store(Request $request){
        $request->validate([
            'category_id'=>'required',
            'subcategory_id'=>'required',
            'product_name'=>'required',
            'product_price'=>'required',
            'prev_img'=>'required',
            'prev_img'=>'image',
        ]);

        
        $remove = array("@", "!", "#", "(", ")", "*", "/", '"');
        $slug = Str::lower( str_replace( $remove , '-', $request->product_name)).'-'.random_int(500000, 600000);
        $prev_img = $request->prev_img;
        $extension = $prev_img->extension();
        $file_name = Str::lower( str_replace( $remove , '-', $request->product_name)).'-'.random_int(50000, 60000).'.'.$extension;
        // return $file_name;
        Image::make($prev_img)->save(public_path('uploads/product/preview/'.$file_name));
        $product_id = Product::insertGetId([
            'category_id'=>$request->category_id,
            'subcategory_id'=>$request->subcategory_id,
            'brand_id'=>$request->brand_id,
            'product_name'=>$request->product_name,
            'product_price'=>$request->product_price,
            'discount'=>$request->discount,
            'after_discount'=>$request->product_price - $request->product_price*$request->discount/100,
            'tags'=> implode(',',$request->tags),
            'short_desp'=>$request->short_desp,
            'long_desp'=>$request->long_desp,
            'addi_info'=>$request->addi_info,
            'prev_img'=>$file_name,
            'slug' => $slug,
            'created_at'=>Carbon::now(),
        ]);

        $galleries = $request->gallery;
        foreach($galleries as $galllery){
            $extension = $galllery->extension();
            $file_name = Str::lower( str_replace(' ', '-', $request->product_name)).'-'.random_int(50000, 60000).'.'.$extension;
            Image::make($galllery)->save(public_path('uploads/product/gallery/'.$file_name));
            ProductGallery::insert([
                'product_id'=>$product_id,
                'gallery'=>$file_name,
                'created_at'=>Carbon::now(),
            ]);
        }
        return back()->with('success', 'Product added successfully');
    }

    function product_list(){
        $products = Product::all();
        return view('product.list',[
            'products'=>$products,
        ]);
    }

    function getstatus(Request $request){
        Product::find($request->product_id)->update([
            'status' => $request->status,
        ]);
    }

    function product_edit($id){
        $products = Product::find($id);
        $categories = Category::all();
        $subcategories = Subcategory::all();
        $brands = Brand::all();
        return view('product.edit',[
            'products'=>$products,
            'categories'=>$categories,
            'subcategories'=>$subcategories,
            'brands'=>$brands,
        ]);
    }

    function product_update(Request $request, $id){
        $request->validate([
            'category_id'=>'required',
            'subcategory_id'=>'required',
            'product_name'=>'required',
            'product_price'=>'required',
            'prev_img'=>'required',
            'prev_img'=>'image',
        ]);
        
        if(!$request->hasFile('prev_img') == ' '){

            Product::find($id)->update([
                'category_id'=>$request->category_id,
                'subcategory_id'=>$request->subcategory_id,
                'brand_id'=>$request->brand_id,
                'product_name'=>$request->product_name,
                'product_price'=>$request->product_price,
                'discount'=>$request->discount,
                'after_discount'=>$request->product_price - $request->product_price*$request->discount/100,
                'tags'=> implode(',',$request->tags),
                'short_desp'=>$request->short_desp,
                'long_desp'=>$request->long_desp,
                'addi_info'=>$request->addi_info,
                'created_at'=>Carbon::now(),
            ]);
        }
        else{
            
            $prev_img = Product::find($id);
            $product_img = public_path('uploads/product/preview/'.$prev_img->prev_img);
            // echo $product_img;
            unlink($product_img);
                
            $remove = array("@", "!", "#", "(", ")", "*", "/", '"');
            $prev_img = $request->prev_img;
            $extension = $prev_img->extension();
            $file_name = Str::lower( str_replace( $remove , '-', $request->product_name)).'-'.random_int(50000, 60000).'.'.$extension;
            // return $file_name;
            Image::make($prev_img)->save(public_path('uploads/product/preview/'.$file_name));
            Product::find($id)->update([
                'category_id'=>$request->category_id,
                'subcategory_id'=>$request->subcategory_id,
                'brand_id'=>$request->brand_id,
                'product_name'=>$request->product_name,
                'product_price'=>$request->product_price,
                'discount'=>$request->discount,
                'after_discount'=>$request->product_price - $request->product_price*$request->discount/100,
                'tags'=> implode(',',$request->tags),
                'short_desp'=>$request->short_desp,
                'long_desp'=>$request->long_desp,
                'addi_info'=>$request->addi_info,
                'prev_img'=>$file_name,
                'created_at'=>Carbon::now(),
            ]);

        }
        
        return back()->with('success', 'Product updated successfully');
    }

    function product_delete($id){
        $prev_img = Product::find($id);
        $product_img = public_path('uploads/product/preview/'.$prev_img->prev_img);
        unlink($product_img);

        Product::find($id)->delete();

        $galleries = ProductGallery::where('product_id', $id)->get();
        foreach($galleries as $galllery){
            $gal_img = ProductGallery::find($id);
            $product_img = public_path('uploads/product/gallery/'.$gal_img->gallery);
            unlink($product_img);
        }
        ProductGallery::find($id)->delete();
        return back()->with('delete', 'Product deleted!!');
    }
}
