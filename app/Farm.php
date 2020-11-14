<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Farm extends Model
{
    public function farmProducts()
    {
        return $this->hasMany('App\FarmProduct', 'farm_id', 'id');
    }

    public function city()
    {
        return $this->belongsTo('App\City', 'city_id', 'id');
    }

    public function orders()
    {
        return $this->hasMany('App\Order');
    }
}