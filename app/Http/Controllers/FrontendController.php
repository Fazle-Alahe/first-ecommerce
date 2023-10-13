<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Category;
use App\Models\Festival;
use App\Models\Offer;
use App\Models\Offer2;
use App\Models\Product;
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
}
