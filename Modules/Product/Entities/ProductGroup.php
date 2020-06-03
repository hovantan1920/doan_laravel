<?php

namespace Modules\Product\Entities;

use Illuminate\Database\Eloquent\Model;

class ProductGroup extends Model
{
    protected $table = "product_groups";
    protected $fillable = ['id', 'title', 'description', 'index'];

    public function products()
    {
        return $this->hasMany('Modules\Product\Entities\Product', 'group_id');
    }
}
