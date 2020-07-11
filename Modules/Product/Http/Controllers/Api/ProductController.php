<?php

namespace Modules\Product\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Product\Transformers\ProductResource;
use Modules\Product\Transformers\ProductSuggestResource;
use Modules\Product\Entities\Product;
use Modules\Product\Entities\Category;

class ProductController extends Controller
{
    public function gets(Request $request){
        try {
            $ids = array_map('intval', explode(',', $request->ids));
            $data = Product::whereIn("id", $ids)->get();
            return response()->json([
                'status'=>1,
                'ids'=>$ids,
                'count'=>count($data),
                'data'=>$data
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status'=> 0,
                'msg'=> $th->getMessage()
            ]);
        }
    }

    public function get(Request $request){
        try {
            $model = Product::findOrFail($request->id);
            return response()->json([
                'status'=> 1,
                'data'=> new ProductResource($model)
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status'=> 0,
                'msg'=> $th->getMessage()
            ]);
        }
    }

    public function suggest(Request $request){
        try {
            $keyword = $request->keyword;
            $offset = (int) $request->offset;
            $limit = (int) $request->limit;
            if($limit == 0)
                $limit = 5; 
            if (!empty($keyword)) {
                $products = Product::where('title', 'LIKE', "%$keyword%")
                    ->orWhere('content', 'LIKE', "%$keyword%");
                $products = $products->offset($offset)->limit($limit)->get();
                return response()->json([
                    'status'=>1,
                    'count'=>count($products),
                    'data'=>ProductSuggestResource::collection($products),
                ]);
            }
            else 
                return response()->json([
                    'status'=>1,
                    'msg'=>'Keyword empty.'
                ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status'=>0,
                'msg'=>'Error: '.$th,
            ]); 
        }
    }

    public function search(Request $request){
        try {
            Category::fixTree();
            $keyword = $request->keyword;
            $category_id = (int) $request->category_id;
            $cates = Category::descendantsAndSelf($category_id);
            $listTemp = [];
            foreach ($cates as $cate) {
                array_push($listTemp, $cate->id);
            }
            $sort_price = (int) $request->sort;
            $offset = (int) $request->offset;
            $limit = (int) $request->limit;
            if($limit == 0)
                $limit = 10; 
                
            $products = Product::where('category_id', '>=', 1);
            if (!empty($keyword)) {
                $products = $products->where('title', 'LIKE', "%$keyword%")
                    ->orWhere('content', 'LIKE', "%$keyword%");
            }
            if($category_id != 0){
                $products = $products->whereIn('category_id', $listTemp);
            }
            if($sort_price == 1){
                $products = $products->orderBy('price', 'asc');
            }
            if($sort_price == 2){
                $products = $products->orderBy('price', 'desc');
            }
            $products = $products->offset($offset)->limit($limit)->get();
            return response()->json([
                'status'=>1,
                'count'=>count($products),
                'data'=>ProductResource::collection($products),
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status'=>0,
                'msg'=>'Error: '.$th,
            ]); 
        }
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('product::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('product::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        return view('product::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        return view('product::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
