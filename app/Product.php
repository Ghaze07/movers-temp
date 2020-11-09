<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    /**
     * Get the farmProduct record associated with the Product.
     */
    public function farmProduct()
    {
        return $this->hasOne('App\FarmProduct');
    }
    public function category()
    {
        return $this->belongsTo('App\ProductCategory', 'product_category_id', 'id');
    }
}