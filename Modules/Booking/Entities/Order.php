<?php

namespace Modules\Booking\Entities;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = "orders";
    protected $fillable = ['id', 'name', 'phone', 'email', 
        'address', 'note', 'ship_id', 'payment_id', 'user_id', 'total', 'discount', 'status'];
    public function detail()
    {
        return $this->hasMany('Modules\Booking\Entities\OrderDetail');
    }
    public function ship()
    {
        return $this->belongsTo('Modules\Booking\Entities\MethodShip');
    }
    public function payment()
    {
        return $this->belongsTo('Modules\Booking\Entities\MethodPayment');
    }
}
