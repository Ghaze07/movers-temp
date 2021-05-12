<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $guarded = [];
    

    protected static function boot()
    {
        parent::boot();
        Booking::created(function($booking) {

            $random_number = rand(1000, 9999);
            $order_number = "M".$random_number;

            $status = "Booking Request submitted";
            $booking->update([
                'booking_number' => $order_number,
                'status' => $status,
            ]);

            $sms = new \App\Sms();
            $sms->user_id = $booking->user->id;
            $sms->to = $booking->user->mobile;
            $sms->body = "Thank you for Booking a Move!, Your Booking Number is:". $booking->booking_number;
            $sms->save();
        
            // Mail::send(new OrderPlaced($booking));
        });
    }
    public function flight()
    {
        return $this->belongsTo('App\Flight');
    }

    public function parking()
    {
        return $this->belongsTo('App\Parking');
    }

    public function service()
    {
        return $this->belongsTo('App\Service');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function from_city()
    {
        return $this->belongsTo('App\City', 'from_city_id', 'id');
    }

    public function to_city()
    {
        return $this->belongsTo('App\City', 'to_city_id', 'id');
    }
}
