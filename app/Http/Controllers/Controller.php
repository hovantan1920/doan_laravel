<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

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
        $bestSellers = Product::where('group_id', Config('product.group-product.best-sellers'))->limit(Config('product.group-product.limit-show'))->get();
        $newProducts = Product::where('group_id', Config('product.group-product.new-products'))->limit(Config('product.group-product.limit-show'))->get();
        // return response()->json([
        //     'best'=>$bestSellers,
        //     'se'=>Config('product.group-product.best-sellers'),
        //     'li'=>Config('product.limit-show')
        // ]);
        return View('index', 
            [
                'categories'=>$categories, 
                'bestSellers'=>$bestSellers, 
                'newProducts'=>$newProducts
            ]);
    }
}
