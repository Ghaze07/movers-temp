<?php

namespace App;

use App\Mail\OrderPlaced;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //
        /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    protected static function boot()
    {
        parent::boot();
        Order::created(function($order) {

            $order_number = $order->address->city->name_abbreviation.sprintf("%04d", $order->id).sprintf("%03d", $order->farm_id).$order->farm->city->name_abbreviation;
            $order->update([
                'order_number' => $order_number
            ]);
            
            $sms = new \App\Sms();
            $sms->user_id = $order->user->id;
            $sms->to = $order->user->mobile;
            $sms->body = "Thank you for your order! Order ". $order->order_number ." has been placed and will arrive shortly.";
            $sms->save();
            $order->farm_id;
            $farm = Farm::find($order->farm_id);

            $sms = new \App\Sms();
            $sms->user_id = $order->user->id;
            $sms->to = $farm->mobile1;
            $sms->body = "A new order ". $order->order_number . " for the amount of ". $order->order_total. " has been placed.";
            $sms->save();

            $sms = new \App\Sms();
            $sms->user_id = $order->user->id;
            $sms->to = $farm->mobile2;
            $sms->body = "A new order ". $order->order_number . " for the amount of ". $order->order_total. " has been placed.";
            $sms->save();

            // get all cart items for this user
            $cart_items = CartItem::where('user_id', $order->user->id)->with('farmProduct')->get();

            // create order items against each cart item
            foreach ($cart_items as $cart_item) {
                OrderItem::create([
                    'user_id' => $cart_item->user_id,
                    'order_id' => $order->id,
                    'farm_product_id' => $cart_item->farm_product_id,
                    'quantity' => $cart_item->quantity,
                ]);
        
                // delete cart items
                $cart_item->delete();
            }
        
            Mail::send(new OrderPlaced($order));
        });
    }

    public function farm()
    {
        return $this->belongsTo('App\Farm');
    }

    public function orderStatus()
    {
        return $this->belongsTo('App\OrderStatus');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function address()
    {
        return $this->belongsTo('App\Address');
    }

    public function orderItems()
    {
        return $this->hasMany('App\OrderItem');
    }
    
    public function orderTrackings()
    {
        return $this->hasMany('App\OrderTracking');
    }
}
