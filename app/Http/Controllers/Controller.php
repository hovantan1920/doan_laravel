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

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function index(){
        Category::fixTree();
        $categories = Category::get()->toTree();
        $bestSellers = Product::where('group_id', Config('product.groups.seller.id'))->limit(Config('product.limit'))->get();
        $newProducts = Product::where('group_id', Config('product.groups.new.id'))->limit(Config('product.limit'))->get();
        // return response()->json([
        //     'best'=>$bestSellers,
        //     'se'=>Config('product.group-product.best-sellers'),
        //     'li'=>Config('product.limit-show')
        // ]);
        
        // $cookie = Cookie::make('name', 'value', 5);
        // return response()->view('index', [
        //     'categories'=>$categories, 
        //     'bestSellers'=>$bestSellers, 
        //     'newProducts'=>$newProducts
        // ])->withCookie($cookie);
        
        return response()->view('index', [
            'categories'=>$categories, 
            'bestSellers'=>$bestSellers, 
            'newProducts'=>$newProducts
        ]);
    }

    public function category($id){
        Category::fixTree();
        $categories = Category::get()->toTree();
        $category = Category::find($id);
        $siblings = $category->siblings()->get();
        $parent = Category::ancestorsOf($id)->first();
        $products = Product::where('category_id', $id)
            ->limit(Config('product.limit'))->get();
        // return response()->json([
        //     'id'=>$id,
        //     'sib'=>$siblings,
        //     'parent'=>$parent,
        //     'cate'=>$category
        // ]);
        return View('bycategory', 
            [
                'categories'=>$categories, 
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
        // $value = Cookie::get('name');
        // return response()->json([
        //     'id'=>$id,
        //     'val'=>$value
        // ]);
        
        return response()->view('detail', [
            'categories'=>$categories, 
            'product'=>$product,
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
