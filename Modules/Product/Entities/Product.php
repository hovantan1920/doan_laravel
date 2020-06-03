<?php

namespace Modules\Product\Entities;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = "products";
    protected $fillable = ['id', 'title', 'content', 'price', 'price_compare', 'category_id', 'image_source', 'group_id'];
    
    public function category()
    {
        return $this->belongsTo('Modules\Product\Entities\Category');
    }
    public function group()
    {
        return $this->belongsTo('Modules\Product\Entities\ProductGroup');
    }
    public function gallery()
    {
        return $this->hasMany('Modules\Product\Entities\Gallery', 'product_id');
    }
}
