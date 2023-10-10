<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Category;
use App\Models\Offer;
use App\Models\Offer2;
use App\Models\Product;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    function welcome(){
        $banners = Banner::all();
        $categories = Category::all();
        $offer = Offer::all();
        $offer2 = Offer2::all();
        $products = Product::latest()->take(8)->get();
        return view('frontend.index',[
            'banners' => $banners,
            'categories' => $categories,
            'offer' => $offer,
            'offer2' => $offer2,
            'products' => $products,
        ]);
    }
}
