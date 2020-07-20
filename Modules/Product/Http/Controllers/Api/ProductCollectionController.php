<?php

namespace Modules\Product\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\Product\Entities\ProductCollection;
use Modules\Product\Entities\Product;
use Modules\Product\Transformers\ProductResource;

class ProductCollectionController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index(Request $request)
    {
        try {

            $limit = $request->limit ?? 12;
            $offset = $request->offset ?? 0;

            $user = Auth::user();
            $collection = $user->productCollection()->get();
            $ids = [];
            foreach ($collection as $col) {
                array_push($ids, $col->product_id);
            }
            $products = Product::whereIn('id', $ids)->offset($offset)->limit($limit)->get();
            return response()->json([
                'status'=>1,
                'count'=>count($products),
                'data'=>ProductResource::collection($products)
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status'=> 0,
                'msg'=> $th->getMessage()
            ]);
        }
    }

    public function check(Request $request){
        try {
            $user = Auth::user();
            $collection = ProductCollection::where('product_id', $request->product_id)->get();
            if(count($collection) > 0){
                return response()->json([
                    'status'=> 1,
                    'data'=> 'true'
                ]);
            }
            else{
                return response()->json([
                    'status'=> 1,
                    'data'=> 'false'
                ]);
            }
            
        } catch (\Throwable $th) {
            return response()->json([
                'status'=> 0,
                'msg'=> $th->getMessage()
            ]);
        }
    }

    public function make(Request $request){
        try {
            $user = Auth::user();
            $check = ProductCollection::where('product_id', $request->product_id)->first();
            if($check){
                $check->delete();
                return response()->json([
                    'status'=> 1,
                    'data'=> 'false'
                ]);
            }
            else{
                $collection = new ProductCollection();
                $collection->user_id = $user->id;
                $collection->product_id = $request->product_id;
                $collection->save();
                return response()->json([
                    'status'=> 1,
                    'data'=> 'true'
                ]);
            }
        } catch (\Throwable $th) {
            return response()->json([
                'status'=> 1,
                'data'=> 'false'
            ]);
        }
    }
}
