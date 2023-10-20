<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Category;
use App\Models\Festival;
use App\Models\Inventory;
use App\Models\Offer;
use App\Models\Offer2;
use App\Models\Product;
use App\Models\ProductGallery;
use App\Models\SpecialOffer;
use App\Models\SpecialOffer2;
use Illuminate\Http\Request;

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
        ]);
    }
}
