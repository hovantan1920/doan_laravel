<?php

namespace Modules\Product\Entities;

use Illuminate\Database\Eloquent\Model;

class ProductCollection extends Model
{
    protected $table = 'product_collection';
    protected $fillable = ['id', 'user_id', 'product_id'];
}
