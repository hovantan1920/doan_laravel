<?php

namespace Modules\Product\Transformers;

use Illuminate\Http\Resources\Json\Resource;
use Modules\Product\Transformers\ProductResource;

class BrandResource extends Resource
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
            'image_source' => $this->image_source,
            'description' => $this->description,
            'country' => $this->country,
            'products' => ProductResource::collection($this->products()->paginate(Config('product.limit')))
        ];
    }
}
