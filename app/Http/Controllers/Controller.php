<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Http\Request;

//Auth
use Illuminate\Support\Facades\Auth;
//Model
use Modules\Product\Entities\Category;
use Modules\Product\Entities\Product;
use Modules\Product\Entities\ProductGroup;
use Modules\Product\Entities\Brand;
use Modules\Theme\Entities\Banner;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct(){
        Category::fixTree();
        $this->categories = Category::get()->toTree();
    }

    public function index(){
        $banners = Banner::orderBy('index', 'asc')->limit(3)->get();
        $groups = ProductGroup::orderBy('index', 'asc')->limit(3)->get();
        $collections = [];
        foreach ($groups as $col) {
            $products = Product::where('group_id', $col->id)->limit(Config('product.limit'))->get();
            array_push($collections, [$col->index=>$products]);
        }
        
        return response()->view('index', [
            'categories'=>$this->categories, 
            'banners'=>$banners,
            'groups'=>$groups,
            'collections'=>$collections,
        ]);
    }

    public function collection($slugParent){

        $categorySlug = $this->getSlug(Category::where('slug', $slugParent)->first());
        $groupSlug = $this->getSlug(ProductGroup::where('slug', $slugParent)->first());
        $brandSlug = $this->getSlug(Brand::where('slug', $slugParent)->first());

        switch ($slugParent) {
            case $categorySlug:
                return 'cate';
                break;
            
            default:
                return $categorySlug;
                break;
        }
    }

    private function getSlug($model){
        return optional($model)->slug;
    }

    private function byCategory($id){
        $category = Category::find($id);
        $siblings = $category->siblings()->get();
        $parent = Category::ancestorsOf($id)->first();
        $children = Category::descendantsOf($id);
        $products = Product::where('category_id', $id)
            ->limit(Config('product.limit'))->get();

        foreach ($children as $child) {
            # code...
        }
        
        // return response()->json([
        //     'id'=>$id,
        //     'sib'=>$siblings,
        //     'parent'=>$parent,
        //     'cate'=>$category
        // ]);
        return View('bycategory', 
            [
                'categories'=>$this-categories, 
                'category'=>$category,
                'siblings'=>$siblings,
                'parent' =>$parent,
                'products'=>$products,
            ]);
    }

    public function detail($id){
        Category::fixTree();
        $categories = Category::get()->toTree();
        $product = Product::find($id);
        $gallery = $product->gallery()->get();
        // $value = Cookie::get('name');
        // return response()->json([
        //     'id'=>$id,
        //     'val'=>$value
        // ]);
        
        return response()->view('detail', [
            'categories'=>$categories, 
            'product'=>$product,
            'gallery'=>$gallery
        ]);;
    }

    public function cart(){
        Category::fixTree();
        $categories = Category::get()->toTree();
        return response()->view('cart', [
            'categories'=>$categories, 
        ]);;
    }

    public function cartProducts(Request $request){
        if(!isset($request->products) || !isset($request->quantities))
            return;

        $products = [];
        foreach ($request->products as $id) {
            array_push($products, Product::find($id));
        }
        return response()->view('contents.cart-content', [
            'quantities'=>$request->quantities,
            'products'=>$products
        ]);;
    }
    public function cartPriceTotal(Request $request){
        if(!isset($request->products) || !isset($request->quantities))
            return;

        $total = 0;
        for ($i=0; $i < count($request->products); $i++) { 
            $total += Product::find($request->products[$i])->price * $request->quantities[$i];
        }
        return response()->view('contents.cart-price-total', [
            'total'=>$total,
        ]);;
    }
    public function cartRelated(Request $request){
        if(!isset($request->products) || !isset($request->quantities))
            return ;

        $categories = [];
        foreach ($request->products as $id) {
            array_push($categories, Product::find($id)->category_id);
        }
        $products = Product::whereIn('category_id', $categories)->inRandomOrder()->limit(Config('product.related'))->get();
        return response()->view('contents.cart-related', [
            'products'=>$products
        ]);;
    }
}
