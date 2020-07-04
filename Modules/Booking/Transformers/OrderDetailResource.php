<?php

namespace Modules\Booking\Transformers;

use Illuminate\Http\Resources\Json\Resource;
use Modules\Product\Entities\Product;

class OrderDetailResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'order_id' => $this->order_id,
            'quantity' => $this->quantity,
            'product' => Product::find($this->product_id),
        ];
    }
}
