<?php

namespace Modules\Booking\Transformers;

use Illuminate\Http\Resources\Json\Resource;
use Modules\Booking\Transformers\OrderDetailResource;
use Illuminate\Support\Carbon;

class OrderResource extends Resource
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
            'phone' => $this->phone,
            'email' => $this->email,
            'ship_id' => $this->ship_id,
            'payment_id' => $this->payment_id,
            'address' => $this->address,
            'note' => $this->note,
            'total' => $this->total,
            'discount' => $this->discount,
            'status'=>$this->status,
            'user_id'=> $this->user_id,
            'created_at'=> Carbon::parse($this->created_at)->format('M d Y'),
            'detail' => OrderDetailResource::collection($this->detail()->get())
        ];
    }
}
