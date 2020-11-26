<?php

namespace App\Http\Controllers;

use App\City;
use App\Farm;
use App\User;
use App\Order;
use App\Region;
use App\Address;
use App\CartItem;
use App\FarmCity;
use App\OrderItem;
use App\FarmProduct;
use App\OrderStatus;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Http\Requests\OrderRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\AddressRequest;
use App\Http\Requests\CartItemRequest;
use App\Http\Requests\AdminOrderRequest;
use App\Http\Requests\AddressUserRequest;

class OrderController extends Controller
{

    public function index()
    {
        $orders = Order::with(['user', 'farm', 'address', 'orderStatus'])->orderBy('created_at', 'desc')->paginate(20);
        $users = User::all();
        $farms = Farm::where('status', 1)->get();
        $regions = Region::where('status', 1)->get();
        $order_statuses = OrderStatus::all();
        return view('order.index')->with([
            'orders' => $orders,
            'users' => $users,
            'farms' => $farms,
            'regions' => $regions,
            'order_statuses' => $order_statuses,
        ]);
    }
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

    public function adminCreateOrder(AdminOrderRequest $request)
    {

        // validation all are required except further instructions
        $request->validated();

        // retrieve address
        $address = Address::find($request->order['address_id']);
        
        // get all cart items for this user
        $cart_items = CartItem::where('user_id', $request->order['user_id'])->with('farmProduct')->get();
        
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
            'user_id' => $request->order['user_id'],
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

    public function adminUpdateOrder(AdminOrderRequest $request, $order_id)
    {

        // validation all are required except further instructions
        $request->validated();

        // retrieve address
        $address = Address::find($request->order['address_id']);
        
        // get all cart items for this user
        $cart_items = CartItem::where('user_id', $request->order['user_id'])->with('farmProduct')->get();
        if(count($cart_items) == 0){
            $cart_items = OrderItem::where('order_id', $order_id)->with('farmProduct')->get();
        }
        // sum up all cart items   
        $order_total = 0;
        foreach ($cart_items as $key => $cart_item) {
            # code...
            $order_total += $cart_item->quantity * $cart_item->farmProduct->unit_price;
        }

        // get farm_id
        $farm_id = $request->order['farm_id'];

        // get delivery_rate for delivery_charges
        $farm_city = FarmCity::where('farm_id', $farm_id)->where('city_id', $address->city_id)->first();

        // create order
        $order = Order::find($order_id);

        $order->update([
            'user_id' => $request->order['user_id'],
            'farm_id' => $farm_id,
            'address_id' => $address->id,
            'order_status_id' => $request->order['order_status_id'],
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
        return response()->json(['message' => 'Your order has been Update Successfully.']);
        
    }

    public function trackOrder(Request $request)
    {
        # code...RWP0001001HBD
        $orderTrackings = Order::where('order_number', $request->order_number)->first()->orderTrackings;
        return response()->json($orderTrackings);
    }

    public function getCities($region_id)
    {
        $cities = City::where('region_id', $region_id)->orderBy('name', 'asc')->get();
        return response()->json($cities);
    }

    public function createUser(UserRequest $request)
    {
        $request->validated();
        $last_user = User::orderBy('id', 'desc')->first();
        $password = mt_rand(100000,999999);
        $email = $request->user['email'] ? $request->user['email'] : 'user'.$last_user->id.'@fishfarm.pk';
        $user = User::create([
            'name' => $request->user['name'],
            'email' => $email,
            'mobile' => $request->user['mobile'],
            'verification_code' => rand(1000, 9999),
            'is_verified' => 1,
            'password' => Hash::make($password),
        ]);

        return response()->json($user);
    }

    public function createAddress(AddressRequest $request)
    {
        # code...
        $request->validated();

        $address = Address::create([
            'user_id' => $request->address['user_id'],
            'city_id' => $request->address['city_id'],
            'complete_address' => $request->address['complete_address'],
        ]);

        return response()->json($address);
    }

    public function createAddressUser(AddressUserRequest $request)
    {
        # code...
        $request->validated();

        $address = Address::create([
            'user_id' => Auth::user()->id,
            'city_id' => $request->address['city_id'],
            'complete_address' => $request->address['complete_address'],
        ]);

        return response()->json($address);
    }

    public function getAddresses($user_id)
    {
        $addresses = Address::where('user_id', $user_id)->get();
        return response()->json($addresses);
    }

    public function getFarmProducts($farm_id)
    {
        $farmProducts = FarmProduct::with('product')->where('farm_id', $farm_id)->get();
        return response()->json($farmProducts);
    }

    public function getCartItems($user_id)
    {
        $cartItems = CartItem::with('farmProduct.product')->where('user_id', $user_id)->get();
        return response()->json($cartItems);
    }

    public function addToCart(CartItemRequest $request)
    {
        $request->validated();
        $cartItem = CartItem::where('farm_product_id', $request->cart_item['farm_product_id'])->where('user_id', $request->cart_item['user_id'])->first();
        if ($cartItem) {
            $cartItem->update([
                'quantity' => $request->cart_item['quantity']
            ]);
        } else {
            $cartItem = CartItem::create([
                'farm_product_id' => $request->cart_item['farm_product_id'],
                'quantity' => $request->cart_item['quantity'],
                'user_id' => $request->cart_item['user_id']
            ]);
        }
        $cartItems = CartItem::with('farmProduct.product')->where('user_id', $request->cart_item['user_id'])->get();
        return response()->json($cartItems);
    }

    public function removeFromCart($id)
    {
        $cartItem = CartItem::find($id);
        $cartItem->delete();
        return response()->json(['message' => 'Cart Item Deleted']);
    }

    public function orderItems($order_id)
    {
        $orderItems = OrderItem::with('farmProduct.product')->where('order_id', $order_id)->get();
        return response()->json($orderItems);
    }
}
