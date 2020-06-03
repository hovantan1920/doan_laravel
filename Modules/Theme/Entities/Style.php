<?php

namespace Modules\Theme\Entities;

use Illuminate\Database\Eloquent\Model;

class Style extends Model
{
    protected $table = "styles";
    protected $fillable = ['id', 'key', 'value', 'description'];
}
