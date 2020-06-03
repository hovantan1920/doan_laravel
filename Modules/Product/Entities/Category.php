<?php

namespace Modules\Product\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Kalnoy\Nestedset\NodeTrait;

class Category extends Model
{
    use NodeTrait;

    protected $table    = 'categories';
    protected $fillable = ['id', 'title', 'description', 'image_source', 'active', 'parent_id'];
    
    public function products()
    {
        return $this->hasMany('Modules\Product\Entities\Product');
    }

    public function parent()
    {
        return $this->belongsTo('Modules\Product\Entities\Category', 'parent_id');
    }

    public function getLftName()
    {
        return '_lft';
    }

    public function getRgtName()
    {
        return '_rgt';
    }

    public function getParentIdName()
    {
        return 'parent_id';
    }
}


