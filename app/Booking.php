<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $guarded = [];
    

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
}
