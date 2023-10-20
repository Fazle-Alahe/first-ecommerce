<?php

namespace App\Http\Controllers;

use App\Models\Color;
use App\Models\Inventory;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    function inventory($id){
        $colors = Color::all();
        $products = Product::find($id);
        $inventories = Inventory::where('product_id', $id)->get();
        return view('product.inventory', [
            'colors'=>$colors,
            'products'=>$products,
            'inventories'=>$inventories,
        ]);
    }

    function inventory_store(Request $request, $id){
        $request->validate([
            'color_id' => 'required',
            'size_id' => 'required',
            'quantity' => 'required',
        ]);

        if(Inventory::where('product_id', $id)->where('color_id', $request->color_id)->where('size_id', $request->size_id)->exists()){
            Inventory::where('product_id', $id)->where('color_id', $request->color_id)->where('size_id', $request->size_id)->increment('quantity', $request->quantity);
            return back()->with('increment', 'Inventory increased!!');
        }

        Inventory::insert([
            'product_id' => $id,
            'color_id' => $request->color_id,
            'size_id' =>  $request->size_id,
            'quantity' => $request->quantity,
            'created_at' => Carbon::now(),
        ]);
        return back()->with('success', 'Inventory added successfully');
    }

    function inventory_delete($id){
        Inventory::find($id)->delete();
        return back()->with('delete', 'Inventory deleted!!');
    }
}
