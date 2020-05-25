<?php

namespace Modules\Product\Entities;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    protected $table = "gallery";
    protected $fillable = ['id', 'index', 'image_source', 'product_id'];

    public function product()
    {
        return $this->belongsTo('Modules\Product\Entities\Product');
    }
}
