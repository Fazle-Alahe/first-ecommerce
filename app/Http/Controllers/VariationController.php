<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Color;
use App\Models\Size;
use Carbon\Carbon;
use Illuminate\Http\Request;

class VariationController extends Controller
{
    function variation(){
        $categories = Category::all();
        $colors = Color::all();
        return view('variation.variation',[
            'categories' => $categories,
            'colors' => $colors,
        ]);
    }

    function color_store(Request $request){
        $request->validate([
            'color_name' => 'required',
        ]);
        Color::insert([
            'color_name' => $request->color_name,
            'color_code' => $request->color_code,
            'created_at' => Carbon::now(),
        ]);
        return back()->with('success', 'Color added successfully');
    }

    function color_delete($id){
        Color::find($id)->delete();
        return back()->with('color_delete', 'Color Deleted!!');
    }

    function size_store(Request $request){
        $request->validate([
            'size_name' => 'required',
        ]);
        Size::insert([
            'category_id' => $request->category_id,
            'size_name' => $request->size_name,
            'created_at' => Carbon::now(),
        ]);
        return back()->with('size_success', 'Size added successfully');
    }
    
    function size_delete($id){
        Size::find($id)->delete();
        return back()->with('size_delete', 'Size Deleted!!');
    }
}
