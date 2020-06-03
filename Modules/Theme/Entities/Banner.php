<?php

namespace Modules\Theme\Entities;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    protected $table = "banners";
    protected $fillable = ['id', 'image_source', 'slogan', 'index'];
}
