<?php

namespace App\Http\Controllers;

use App\CartItem;
use App\FarmProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class CartItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->cartItem;

        if (Auth::user()) {
            $data['user_id'] = Auth::user()->id;
            // not checking current cart OR order yet
            $cartItem = CartItem::where('user_id', Auth::user()->id)->where('farm_product_id', $request->cartItem['farm_product_id'])->first();
            // update if already exist else create
            if ($cartItem) {
                $quantity = $cartItem->quantity + $request->cartItem['quantity'];
                $cartItem->update(['quantity' => $quantity]);
            } else {
                $cartItem = CartItem::create($data);
            }
            // with relationship and relationship of relationship
            $cartItem = CartItem::with('farmProduct.product')->where('id', $cartItem->id)->first();
            return response()->json($cartItem);
        } else {
            // default values
            $quantity = 0;
            $already_exists = false;
            // get farm_product for product name, unit price
            $FarmProduct = FarmProduct::with('product')->where('id', $request->cartItem['farm_product_id'])->first();
            if ($request->session()->exists('cartItems')) {
                $cartItems = session('cartItems');
                foreach ($cartItems as $key => $cartItem) {
                    foreach ($cartItem as $farm_product_id => $product_quantity) {
                        // if product exist and match
                        if ($farm_product_id == $request->cartItem['farm_product_id']) {
                            // updating array of array
                            $cartItem[$farm_product_id] = $quantity = $product_quantity + $request->cartItem['quantity'];
                            // updating array
                            $cartItems[$key] = $cartItem;
                            // updating flag
                            $already_exists = true;
                        }
                    }
                }
                // updating session
                $request->session()->put('cartItems', $cartItems);
            }
            // if new product create new 
            if (!$already_exists) {
                $request->session()->push('cartItems', [$request->cartItem['farm_product_id'] => $request->cartItem['quantity']]);
                $quantity = $request->cartItem['quantity'];
            }
            return response()->json([$FarmProduct, $quantity]);
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\CartItem  $cartItem
     * @return \Illuminate\Http\Response
     */
    public function show(CartItem $cartItem)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\CartItem  $cartItem
     * @return \Illuminate\Http\Response
     */
    public function edit(CartItem $cartItem)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CartItem  $cartItem
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CartItem $cartItem)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CartItem  $cartItem
     * @return \Illuminate\Http\Response
     */
    public function destroy(CartItem $cartItem)
    {
        //
    }
}
