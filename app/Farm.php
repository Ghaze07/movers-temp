<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Farm extends Model
{
    public function farmProducts()
    {
        return $this->hasMany('App\FarmProduct', 'id', 'farm_id');
    }
}