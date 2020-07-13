<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    protected $token;

    public function pushToken($value){
        $this->token = $value;
        return $this;
    }

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'=>$this->id,
            'name'=>$this->name,
            'avatar'=>$this->avatar,
            'email'=>$this->email,
            'birthday'=>$this->birthday,
            'gender'=>$this->gender,
            'numberphone'=>$this->numberphone,
            'token'=>$this->token
        ];
    }
}
