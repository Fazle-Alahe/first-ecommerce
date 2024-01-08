<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use App\Models\Order;
use App\Models\OrderCancel;
use App\Models\OrderProducts;
use App\Models\OrderReturn;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

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

        // if($request->status == 5){
        //     foreach($order_products as $order_product){
        //         Inventory::where('product_id', $order_product->product_id)->where('color_id', $order_product->color_id)->where('size_id', $order_product->size_id)->increment('quantity', $order_product->quantity);
        //     }
        //     return back()->with('order_cancle', 'Order Canceled!');
        // }
        return back();
    }

    function cancel_order($id){
        $order_info = Order::find($id);
        return view('frontend.customer.cancel_order', [
            'order_info' => $order_info,
        ]);
    }

    function order_cancel_req(Request $request,$id){
        $request->validate([
            'reason' => 'required',
        ]);
        if($request->hasFile('image')){
            $image = $request->image;
            $extension = $image->extension();
            $file_name = random_int(10000,90000).'.'.$extension;
            Image::make($image)->save(public_path('uploads/cancel_order/'.$file_name));

            OrderCancel::insert([
                'order_id' => $id,
                'reason' => $request->reason,
                'image' => $file_name,
                'created_at' => Carbon::now(),
            ]);
        }
        else{
            OrderCancel::insert([
                'order_id' => $id,
                'reason' => $request->reason,
                'created_at' => Carbon::now(),
            ]);
        }
        
        return redirect()->route('my.orders')->with('req', 'Order cancel request sent');
    }

    function order_cancel_list(){
        $order_cancel_lists = OrderCancel::all();
        return view('orders.order_cancel_list',[
            'order_cancel_lists' => $order_cancel_lists,
        ]);
    }

    function cancel_details($id){
        $details = OrderCancel::find($id);
        return view('orders.order_cancel_details', [
            'details' => $details,
        ]);
    }

    function cancel_accept($id){
        $details = OrderCancel::find($id);
        Order::find($details->order_id)->update([
            'status' => 5,
        ]);
        
        $order = Order::find($details->order_id);
        $order_products = OrderProducts::where('order_id', $order->order_id)->get();
        foreach($order_products as $order_product){
            Inventory::where('product_id', $order_product->product_id)->where('color_id', $order_product->color_id)->where('size_id', $order_product->size_id)->increment('quantity', $order_product->quantity);
        }
        OrderCancel::find($id)->delete();
        return back()->with('order_cancle', 'Order Canceled!');
    }

    function order_return($id){
        $order_info = Order::find($id);
        return view('frontend.customer.return_order', [
            'order_info' => $order_info,
        ]);
    }

    function order_return_store(Request $request,$id){
        
        $request->validate([
            'reason' => 'required',
        ]);
        if($request->hasFile('image')){
            $image = $request->image;
            $extension = $image->extension();
            $file_name = random_int(10000,90000).'.'.$extension;
            Image::make($image)->save(public_path('uploads/return_product/'.$file_name));

            OrderReturn::insert([
                'order_id' => $id,
                'reason' => $request->reason,
                'image' => $file_name,
                'created_at' => Carbon::now(),
            ]);
        }
        else{
            OrderReturn::insert([
                'order_id' => $id,
                'reason' => $request->reason,
                'created_at' => Carbon::now(),
            ]);
        }
        
        return redirect()->route('my.orders')->with('return', 'Return request sent');
    }

    
    function order_returns_list(){
        $order_return_lists = OrderReturn::all();
        return view('orders.order_return_list',[
            'order_return_lists' => $order_return_lists,
        ]);
    }

    function returns_details($id){
        $details = OrderReturn::find($id);
        return view('orders.order_return_details', [
            'details' => $details,
        ]);
    }

    
    function returns_accept($id){
        $details = OrderReturn::find($id);
        Order::find($details->order_id)->update([
            'status' => 6,
        ]);
        
        $order = Order::find($details->order_id);
        $order_products = OrderProducts::where('order_id', $order->order_id)->get();
        foreach($order_products as $order_product){
            Inventory::where('product_id', $order_product->product_id)->where('color_id', $order_product->color_id)->where('size_id', $order_product->size_id)->increment('quantity', $order_product->quantity);
        }
        OrderReturn::find($id)->delete();
        return back()->with('order_return', 'Order Returned!');
    }

    function order_cancel_admin($id){
        $order_info = Order::find($id);
        return view('orders.order_cancel_admin',[
            'order_info' => $order_info,
        ]);
    }

    
    function order_cancel_store_admin(Request $request,$id){
        
        $request->validate([
            'reason' => 'required',
        ]);
        if($request->hasFile('image')){
            $image = $request->image;
            $extension = $image->extension();
            $file_name = random_int(10000,90000).'.'.$extension;
            Image::make($image)->save(public_path('uploads/return_product/'.$file_name));

            OrderCancel::insert([
                'order_id' => $id,
                'reason' => $request->reason,
                'image' => $file_name,
                'created_at' => Carbon::now(),
            ]);
        }
        else{
            OrderCancel::insert([
                'order_id' => $id,
                'reason' => $request->reason,
                'created_at' => Carbon::now(),
            ]);
        }
        
        return redirect()->route('order.cancel.list')->with('return', 'Return request sent');
    }

}
