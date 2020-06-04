<?php

namespace Modules\Product\Entities;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $table    = 'brands';
    protected $fillable = ['id', 'title', 'description', 'image_source', 'country', 'slug'];
    
    public function products()
    {
        return $this->hasMany('Modules\Product\Entities\Product');
    }
}
