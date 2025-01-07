<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Category;
use App\Models\Festival;
use App\Models\Inventory;
use App\Models\Offer;
use App\Models\Offer2;
use App\Models\OrderProducts;
use App\Models\Product;
use App\Models\ProductGallery;
use App\Models\SpecialOffer;
use App\Models\SpecialOffer2;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class FrontendController extends Controller
{
    function welcome(){
        $banners = Banner::all();
        $categories = Category::all();
        $offer = Offer::all();
        $offer2 = Offer2::all();
        $products = Product::latest()->take(8)->get();
        $festivals = Festival::all();
        $special_offers = SpecialOffer::all();
        $special_offers2 = SpecialOffer2::all();
        return view('frontend.index',[
            'banners' => $banners,
            'categories' => $categories,
            'offer' => $offer,
            'offer2' => $offer2,
            'products' => $products,
            'festivals' => $festivals,
            'special_offers' => $special_offers,
            'special_offers2' => $special_offers2,
        ]);
    }

    function product_details($slug){
        $product_id = Product::where('slug', $slug)->first()->id;
        $product_info = Product::find($product_id);
        $galleries = ProductGallery::where('product_id', $product_id)->get();
        $reviews = OrderProducts::where('product_id', $product_id)->whereNotNull('review')->get();

        $available_colors = Inventory::where('product_id', $product_id)
        ->groupBy('color_id')
        ->selectRaw('sum(color_id) as sum, color_id')
        ->get();

        $available_size = Inventory::where('product_id', $product_id)
        ->groupBy('size_id')
        ->selectRaw('sum(size_id) as sum, size_id')
        ->get();

        return view('frontend.product_details',[
            'galleries' => $galleries,
            'product_info' => $product_info,
            'available_colors' => $available_colors,
            'available_size' => $available_size,
            'reviews' => $reviews,
        ]);
    }


    function all_products(){
        $products = Product::all();
        return view('frontend.product_view_all',[
            'products' => $products,
        ]);
    }

    function getSize(Request $request){
        $str = '';
        $sizes = Inventory::where('product_id', $request->product_id)->where('color_id', $request->color_id)->get();
        foreach($sizes as $size){
            if($size -> rel_to_size -> size_name == 'NA'){
                $str = '<li class="color"><input class="size_id" checked id="size'.$size->size_id.'" type="radio" name="size_id" value="'.$size->size_id.'">
                <label for="size'.$size->size_id.'">'.$size->rel_to_size->size_name.'</label>
            </li>';
            }
            else{
                $str .= '<li class="color"><input class="size_id" id="size'.$size->size_id.'" type="radio" name="size_id" value="'.$size->size_id.'">
                <label for="size'.$size->size_id.'">'.$size->rel_to_size->size_name.'</label>
                </li>';
            }
        }
        echo $str;
    }

    function getQuantity(Request $request){
        $str = '';
        $quantity =  Inventory::where('product_id', $request->product_id)->where('color_id', $request->color_id)->where('size_id', $request->size_id)->first()->quantity;
        if($quantity == 0){
            $str = '<strong id="quan" class="btn btn-danger">Out of Stock</strong>';
        }
        else{
            $str = '<strong id="quan" class="btn btn-success">'.$quantity.' In Stock</strong>';
        }
        echo $str;
    }

    function review_storees(Request $request, $id){
        if($request->hasFile('image')){
            $image = $request->image;
            $extension = $image->extension();
            $file_name = Str::lower( str_replace(' ', '-', 'review')).'-'.random_int(50000, 60000).'.'.$extension;
            Image::make($image)->save(public_path('uploads/review/'.$file_name));

            OrderProducts::where('customer_id', Auth::guard('customer')->id())->where('product_id', $id)->first()->update([
                'review' => $request->review,
                'stars' => $request->stars,
                'image' => $file_name,
                'created_at' => Carbon::now(),
            ]);
        }
        else{
            OrderProducts::where('customer_id', Auth::guard('customer')->id())->where('product_id', $id)->first()->update([
                'review' => $request->review,
                'star' => $request->stars,
                'created_at' => Carbon::now(),
            ]);
        }
        return back()->with('review', 'Review submitted successfully');
    }

    public function category_products($id){
        $products = Product::where('category_id', $id)->get();
        return view('frontend.category_product',[
            'products' => $products,
        ]);
    }
}
