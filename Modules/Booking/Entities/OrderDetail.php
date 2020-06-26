<?php

namespace Modules\Booking\Entities;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    protected $table = "orders_detail";
    protected $fillable = ['id', 'order_id', 'product_id', 'quantity'];
}
