<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use App\Models\Offer2;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Illuminate\Http\Request;

class OfferController extends Controller
{
    function offer(){
        $offer = Offer::all();
        $offer2 = Offer2::all();
        return view('offer.offer',[
            'offer' => $offer,
            'offer2' => $offer2,
        ]);
    }

    function offer1_store(Request $request){
        $request->validate([
            'title' => 'required',
            'price' => 'required',
            'discount_price' => 'required',
            'image' => 'image',
        ]);

        if($request->hasFile('image') == ''){
            Offer::where('id', 7)->update([
                'title' => $request->title,
                'price' => $request->price,
                'discount_price' => $request->discount_price,
                'date'=>$request->date,
            ]);
        }

        else{
            $img = Offer::first();
            $img_delete = public_path('uploads/offer/'.$img->image);
            unlink($img_delete);

            $image = $request->image;
            $extension = $image->extension();
            $file_name = Str::lower( str_replace(' ', '-', $request->title)).'-'.random_int(50000, 60000).'.'.$extension;
            Image::make($image)->save(public_path('uploads/offer/'.$file_name));

            Offer::where('id', 7)->update([
                'title' => $request->title,
                'price' => $request->price,
                'discount_price' => $request->discount_price,
                'image'=>$file_name,
                'date'=>$request->date,
            ]);
        }
        return back()->with('success', 'Offer1 updated successfully');
    }
    function offer2_store(Request $request){
        $request->validate([
            'title2' => 'required',
            'subtitle' => 'required',
            'image2' => 'image',
        ]);

        if($request->hasFile('image2') == ''){
            Offer2::where('id', 1)->update([
                'title2' => $request->title2,
                'subtitle' => $request->subtitle,
            ]);
        }

        else{
            $img = Offer2::first();
            $img_delete = public_path('uploads/offer/'.$img->image2);
            unlink($img_delete);

            $image = $request->image2;
            $extension = $image->extension();
            $file_name = Str::lower( str_replace(' ', '-', $request->title2)).'-'.random_int(50000, 60000).'.'.$extension;
            Image::make($image)->save(public_path('uploads/offer/'.$file_name));

            Offer2::where('id', 1)->update([
                'title2' => $request->title2,
                'subtitle' => $request->subtitle,
                'image2'=>$file_name,
            ]);
        }
           
        return back()->with('success2', 'Offer2 updated successfully');
    }
}
