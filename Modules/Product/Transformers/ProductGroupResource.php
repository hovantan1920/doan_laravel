<?php

namespace Modules\Product\Transformers;

use Illuminate\Http\Resources\Json\Resource;
use Modules\Product\Transformers\ProductResource;

class ProductGroupResource extends Resource
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
            'index' => $this->index,
            'products' => ProductResource::collection($this->products()->paginate(Config('product.limit')))
        ];
    }
}
