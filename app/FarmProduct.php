<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FarmProduct extends Model
{
    public function product()
    {
        return $this->belongsTo('App\Product', 'product_id', 'id');
    }

    public function productSource()
    {
        return $this->belongsTo('App\ProductSource', 'product_source_id', 'id');
    }

    public function measuringUnit()
    {
        return $this->belongsTo('App\MeasuringUnit', 'measuring_unit_id', 'id');
    }
}