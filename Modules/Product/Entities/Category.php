<?php

namespace Modules\Product\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Category extends Model
{
    protected $table    = 'categories';
    protected $fillable = ['id', 'title', 'description', 'image_source', 'active', 'parent_id'];
    
    public function products()
    {
        return $this->hasMany('Modules\Product\Entities\Product');
    }
}


