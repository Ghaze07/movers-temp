<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    //
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * Get the user that owns the CartItem.
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * Get the farmProduct that owns the CartItem.
     */
    public function farmProduct()
    {
        return $this->belongsTo('App\FarmProduct');
    }
}
