<?php

namespace Modules\Product\Transformers;

use Illuminate\Http\Resources\Json\Resource;

class ProductResource extends Resource
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
            'title' => $this->title,
            'content' => $this->content,
            'price' => $this->price,
            'image_source' => $this->image_source,
            'price_compare' => $this->price_compare,
            'gallery'=>$this->gallery()->get(),
            'related'=>$this->related($this->category_id, $this->group_id),
            
            // 'category_id'=> $this->category_id,
            // 'group_id'=> $this->group_id,
            // 'brand_id'=> $this->brand_id,
        
            'category' => $this->category()->first(),
            'group' => $this->group()->first(),
            'brand' => $this->brand()->first(),
        ];
    }
}
