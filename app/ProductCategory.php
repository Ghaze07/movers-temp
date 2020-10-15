<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    public function product()
    {
        return $this->hasMany('App\Product', 'id', 'product_category_id');

    }
}