<?php

namespace App\Http\Controllers;

use App\Models\SpecialOffer;
use App\Models\SpecialOffer2;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Illuminate\Http\Request;

class SpecialOfferController extends Controller
{
   function special_offer(){
    $special_offers = SpecialOffer::all();
    $special_offers2 = SpecialOffer2::all();
        return view('offer.special_offer',[
            'special_offers' => $special_offers,
            'special_offers2' => $special_offers2,
        ]);
   }

   function special_offer_store(Request $request){

        $request->validate([
            'product_name' => 'required',
            'price' => 'required',
            'discount_price' => 'required',
            'image' => 'image',
        ]);

        if($request->hasFile('image') == ''){
            SpecialOffer::where('id', 1)->update([
                'product_name' => $request->product_name,
                'price' => $request->price,
                'discount_price' => $request->discount_price,
            ]);
        }

        else{
            $img = SpecialOffer::first();
            $img_delete = public_path('uploads/offer/'.$img->image);
            unlink($img_delete);

            $image = $request->image;
            $extension = $image->extension();
            $file_name = Str::lower( str_replace(' ', '-', $request->product_name)).'-'.random_int(50000, 60000).'.'.$extension;
            Image::make($image)->save(public_path('uploads/offer/'.$file_name));

            SpecialOffer::where('id', 1)->update([
                'product_name' => $request->product_name,
                'price' => $request->price,
                'discount_price' => $request->discount_price,
                'image'=>$file_name,
            ]);
        }
        return back()->with('success', 'Special Offer 1 updated successfully');
    }

    
   function special_offer2_store(Request $request){

        $request->validate([
            'product_name2' => 'required',
            'price2' => 'required',
            'discount_price2' => 'required',
            'image2' => 'image',
        ]);

        if($request->hasFile('image2') == ''){
            SpecialOffer2::where('id', 1)->update([
                'product_name2' => $request->product_name2,
                'price2' => $request->price2,
                'discount_price2' => $request->discount_price2,
            ]);
        }

        else{
            $img = SpecialOffer2::first();
            $img_delete = public_path('uploads/offer/'.$img->image2);
            unlink($img_delete);

            $image = $request->image2;
            $extension = $image->extension();
            $file_name = Str::lower( str_replace(' ', '-', 'second_offer')).'-'.random_int(50000, 60000).'.'.$extension;
            Image::make($image)->save(public_path('uploads/offer/'.$file_name));

            SpecialOffer2::where('id', 1)->update([
                'product_name2' => $request->product_name2,
                'price2' => $request->price2,
                'discount_price2' => $request->discount_price2,
                'image2'=>$file_name,
            ]);
        }
        return back()->with('success2', 'Special Offer 2 updated successfully');
    }
}

