<?php

namespace Modules\Product\Transformers;

use Illuminate\Http\Resources\Json\Resource;
use Modules\Product\Transformers\ProductResource;
use Modules\Product\Entities\Product;
use Modules\Product\Entities\Category;

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
        $arrId = [$this->id];
        Category::fixTree();
        $children = Category::descendantsOf($this->id)->toTree();
        foreach ($children as $child) {
            array_push($arrId, $child->id);
        }
        $offset = (int) $request->offset;
        $limit = (int) $request->limit;
        if($limit == 0)
            $limit = 10; 
        $products = Product::whereIn('category_id', $arrId)->offset($offset)->limit($limit)->get();

        return [
            'id' => $this->id,
            'title' => $this->title,
            'image_source' => $this->image_source,
            'parent' => $this->parent()->first(),
            'children' => $this->descendantsOf($this->id)->toTree(),
            'products' =>$products,
        ];
    }
}
