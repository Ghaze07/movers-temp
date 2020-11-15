<?php

namespace App\Http\Controllers;

use App\City;
use App\User;
use App\Order;
use App\Address;
use App\CartItem;
use App\FarmCity;
use App\Http\Requests\OrderRequest;
use App\OrderItem;
use App\OrderStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{

    public function setReceiver()
    {
        $user = User::find(Auth::user()->id, ['name', 'mobile']);
        return response()->json($user);
    }

    public function placeOrder(OrderRequest $request)
    {

        // validation all are required except further instructions
        $request->validated();
        // save or retrieve address
        if ($request->address) {
            $address = Address::create([
                'user_id' => Auth::user()->id,
                'city_id' => $request->address['city'],
                'complete_address' => $request->address['complete_address']
            ]);
        } else {
            $address = Address::find($request->order['address_id']);
        }
        // get all cart items for this user
        $cart_items = CartItem::where('user_id', Auth::user()->id)->with('farmProduct')->get();
        
        // sum up all cart items   
        $order_total = 0;
        foreach ($cart_items as $key => $cart_item) {
            # code...
            $order_total += $cart_item->quantity * $cart_item->farmProduct->unit_price;
        }

        // get farm_id
        $farm_id = $cart_items->first()->farmProduct->farm_id;

        // get delivery_rate for delivery_charges
        $farm_city = FarmCity::where('farm_id', $farm_id)->where('city_id', $address->city_id)->first();

        // get order_status for order_status_id
        $order_status = OrderStatus::where('status', 'New')->first();

        // create order
        $order = Order::create([
            'user_id' => Auth::user()->id,
            'farm_id' => $farm_id,
            'address_id' => $address->id,
            'order_status_id' => $order_status->id,
            'order_total' => $order_total,
            'delivery_charges' => $farm_city->delivery_rate,
            'cash_on_delivery' => $order_total + $farm_city->delivery_rate,
            'processing_option' => $request->order['processing_option'],
            'further_instructions' => $request->order['further_instructions'],
            'receiver_name' => $request->order['receiver']['name'],
            'receiver_mobile' => $request->order['receiver']['mobile'],
        ]);

        // sms to user and farm official number

        // success message
        return response()->json(['message' => 'Your order has been placed Successfully.']);
        
    }
}
