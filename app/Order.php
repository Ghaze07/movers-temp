<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

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
            $sms = new \App\Sms();
            $sms->user_id = Auth::user()->id;
            $sms->to = Auth::user()->mobile;
            $sms->body = "Thank you for your order! Order ". $order->order_number ." has been placed and will arrive shortly.";
            $sms->save();

            // $sms = new \App\Sms();
            // $sms->user_id = Auth::user()->id;
            // $sms->to = '3439296224';
            // $sms->body = "Thank you for your order! Order ". $order->order_number ." has been placed and will arrive shortly.";
            // $sms->save();

            // $sms = new \App\Sms();
            // $sms->user_id = Auth::user()->id;
            // $sms->to = '3215791372';
            // $sms->body = "Thank you for your order! Order ". $order->order_number ." has been placed and will arrive shortly.";
            // $sms->save();
        });
    }
}
