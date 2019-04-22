<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model
{
    public function categories()
    {
        return $this->belongsTo('App\CategoryService', 'cateId', 'id');
    }
}
