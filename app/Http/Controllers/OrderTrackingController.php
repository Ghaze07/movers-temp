<?php

namespace App\Http\Controllers;

use App\Order;
use App\OrderTracking;
use Illuminate\Support\Facades\Auth;

class OrderTrackingController extends Controller
{
    public function index()
    {
            $user_id = Auth::user()->id;
            $orders = Order::where(['user_id'=>$user_id])->with('OrderItems.farmProduct.product')->get();
            
        return view('myOrders.index',compact('orders'));
    }

    public function orderStatus($id)
    {
        $orderTracking = OrderTracking::where(['order_id'=> $id])->get();
        return view('myOrders.orderStatus',compact('orderTracking'));
        
    }
}
