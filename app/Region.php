<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    public function country()
    {
        return $this->belongsTo('App\Country', 'country_id', 'id');
    }

    public function cities()
    {
        return $this->hasMany('App\City', 'id', 'region_id');
    }
}