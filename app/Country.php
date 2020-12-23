<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $guarded = [];
    public function regions()
    {
        return $this->hasMany('App\Region', 'id', 'country_id');
    }
}