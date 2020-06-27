<?php

namespace Modules\Product\Entities;

use Illuminate\Database\Eloquent\Model;

class ProductCollection extends Model
{
    protected $fillable = ['id', 'user_id', 'product_id'];
}
