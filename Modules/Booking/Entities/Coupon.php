<?php

namespace Modules\Booking\Entities;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    protected $table = "coupons";
    protected $fillable = ['id', 'title', 'code', 
        'description', 'image_source', 'type', 'discount', 'max', 
        'count', 'condition', 'expired'];
}
