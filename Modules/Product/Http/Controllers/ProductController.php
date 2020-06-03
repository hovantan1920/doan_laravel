<?php

namespace Modules\Product\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
//Auth
use Illuminate\Support\Facades\Auth;
//Model
use Modules\Product\Entities\Product;
use Modules\Product\Entities\Category;
use Modules\Product\Entities\Gallery;
use Modules\Product\Entities\ProductGroup;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $name       = "products";
        $data = Product::paginate(10);
        $categories = Category::where('parent_id', '>', 0)->get();
        $groups = ProductGroup::all();
        return view('product::products',
        ['profile'=> Auth::user(), 'list'=>$data, 'name' => $name, 'categories'=>$categories, 'groups'=>$groups]);
    }

    /**1
     *  Display a listing data
     * @return View
     */
    public function create()
    {
        $data = Product::paginate(10);
        $categories = Category::where('parent_id', '>', 0)->get();
        $groups = ProductGroup::all();
        return view('product::body.products', ['list'=>$data, 'categories'=>$categories, 'groups'=>$groups]);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'title' => 'required',
                'content' => 'required',
                'category_id' => 'required|exists:categories,id',
                'group_id' => 'nullable|exists:product_groups,id',
            ]);
    
            $status = false;
            $data = $request->all();
            $model = new Product();
            $model->title = $request->title;
            $model->content = $request->content;
            $model->image_source = $request->image_source;
            $model->price = $request->price;
            $model->price_compare = $request->price_compare;
            $model->category_id = $request->category_id;
            $model->group_id = $request->group_id;
            $status = $model->save();

            if(isset($request->gallery) && $status){
                $gallery = [];
                foreach ($request->gallery as $image) {
                    array_push($gallery, ['image_source'=> $image, 'product_id' => $model->id]);
                }
                Gallery::insert($gallery);
            }
            
            return response()->json(['success' => $status]);
        } catch (\Throwable $th) {
            return response()->json(['success' => false, 'msg' => $th->getMessage()]);
        }
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        try {
            $rs = Product::where('id', $id)->first();
            $gallery = $rs->gallery()->get();
            return response()->json([
                'success' => true,
                'id'=>$id,
                'result' => $rs,
                'gallery'=> $gallery
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'msg' => $th->getMessage()
            ], 200);
        }
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        try {
            $status = Product::where('id', $id)->update($request->except(['_token', 'gallery']));
            if($status){
                $gallery = [];
                if(isset($request->gallery)){
                    Gallery::where('product_id', $id)->delete();
                    foreach ($request->gallery as $image) {
                        array_push($gallery, ['image_source'=> $image, 'product_id' => $id]);
                    }
                    Gallery::insert($gallery);
                }
            }
            return response()->json(['success' => $status, 'data'=> $request->all()]);
        } catch (\Throwable $th) {
            return response()->json(['success' => false, 'msg'=> $th->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        try {
            $status = Product::where('id', $id)->delete();
            return response()->json(['success' => $status]);
        } catch (\Throwable $th) {
            return response()->json(['success' => false, 'msg'=> $th->getMessage()]);
        }
    }
}
