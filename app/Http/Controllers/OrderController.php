<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use App\Models\Order;
use App\Models\OrderProducts;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    function orders(){
        $orders = Order::latest()->get();
        return view('orders.orders',[
            'orders' => $orders,
        ]);
    }

    function order_status_update(Request $request, $id){
        Order::find($id)->update([
            'status' => $request->status,
        ]);

        $order = Order::find($id);
        $order_products = OrderProducts::where('order_id', $order->order_id)->get();

        if($request->status == 5){
            foreach($order_products as $order_product){
                Inventory::where('product_id', $order_product->product_id)->where('color_id', $order_product->color_id)->where('size_id', $order_product->size_id)->increment('quantity', $order_product->quantity);
            }
            return back()->with('order_cancle', 'Order Canceled!');
        }
        return back();
    }
}
