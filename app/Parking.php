<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Parking extends Model
{
    protected $guarded = [];

    public function bookings()
    {
        return $this->hasMany('App\Booking');
    }
}
