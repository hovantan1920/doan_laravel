<?php

namespace Modules\Booking\Entities;

use Illuminate\Database\Eloquent\Model;

class MethodPayment extends Model
{
    protected $table = "method_payment";
    protected $fillable = ['id', 'title', 'information'];
}
