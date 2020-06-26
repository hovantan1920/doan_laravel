<?php

namespace Modules\Booking\Entities;

use Illuminate\Database\Eloquent\Model;

class MethodShip extends Model
{
    protected $table = "method_ship";
    protected $fillable = ['id', 'title', 'information'];
}
