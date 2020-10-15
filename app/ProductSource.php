<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductSource extends Model
{
    public function farmProducts()
    {
        return $this->hasMany('App\FarmProduct', 'id', 'product_source_id');
    }
}