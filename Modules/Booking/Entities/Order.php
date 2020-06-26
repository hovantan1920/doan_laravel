<?php

namespace Modules\Booking\Entities;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = "orders";
    protected $fillable = ['id', 'name', 'phone', 'email', 
        'address', 'note', 'ship_id', 'payment_id', 'user_id'];
    public function detail()
    {
        return $this->hasMany('Modules\Booking\Entities\OrderDetail');
    }
}
