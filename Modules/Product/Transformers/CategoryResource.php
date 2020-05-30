<?php

namespace Modules\Product\Transformers;

use Illuminate\Http\Resources\Json\Resource;

class CategoryResource extends Resource
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
            'description' => $this->description,
            'image_source' => $this->image_source,
            'parent_id' => $this->parent_id,
            'children' => UserResource::collection(($this->descendantsOf($this->id)->toTree()))
        ];
    }
}
