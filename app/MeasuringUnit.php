<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MeasuringUnit extends Model
{
    public function farmProducts()
    {
        return $this->hasMany('App\FarmProduct', 'id', 'measuring_unit_id');
    }
}