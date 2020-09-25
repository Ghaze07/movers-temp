<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected function topFive()
    {
        return Blog::where(['published' => true])->orderBy('views', 'desc')->limit(5)->get();
    }

    public function author()
    {
        return $this->belongsTo('App\Author', 'author_id', 'id');
    }
}
