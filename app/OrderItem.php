<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    //
        /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    public function order()
    {
        return $this->belongsTo('App\Order');
    }

    public function farmProduct()
    {
        return $this->belongsTo('App\FarmProduct');
    }
}
