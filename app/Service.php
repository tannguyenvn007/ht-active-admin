<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    //
    protected $table = 'services';

    public function categoryService()
    {
        return $this->belongsTo('App\CategoryService', 'cate_serviceId', 'id');
    }
}
