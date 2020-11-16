<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderTracking extends Model
{
    //
    protected $guarded = [];
    
    public function order()
    {
        return $this->belongsTo('App\Order');
    }

    public function orderStatus()
    {
        return $this->belongsTo('App\OrderStatus');
    }
}
