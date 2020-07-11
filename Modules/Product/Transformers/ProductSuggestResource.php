<?php

namespace Modules\Product\Transformers;

use Illuminate\Http\Resources\Json\Resource;

class ProductSuggestResource extends Resource
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
            'image_source' => $this->image_source
        ];
    }
}
