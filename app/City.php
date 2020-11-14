<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    public function region()
    {
        return $this->belongsTo('App\Region', 'region_id', 'id');
    }
    public function orders()
    {
        return $this->hasMany('App\Order');
    }
    public function addresses()
    {
        return $this->hasMany('App\Address');
    }
}