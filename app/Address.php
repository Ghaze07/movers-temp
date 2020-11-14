<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    public function orders()
    {
        return $this->hasMany('App\Order');
    }
    public function city()
    {
        return $this->belongsTo('App\City');
    }
}
