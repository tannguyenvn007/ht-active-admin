<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategoryService extends Model
{
    //
    protected $table = 'category_services';

    public function services()
    {
        return $this->hasMany('App\Service', 'cate_serviceId','id');
    }
    public function portfolios()
    {
        return $this->hasMany('App\Portfolio', 'cateId','id');
    }
}

