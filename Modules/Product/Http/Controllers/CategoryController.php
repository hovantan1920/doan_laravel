<?php

namespace Modules\Product\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
//Auth
use Illuminate\Support\Facades\Auth;
//Model
use Modules\Product\Entities\Category;


class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $name       = "categories";
        $categories = Category::paginate(10);
        $parents = Category::where('parent_id', null)->get();
        return view('product::admin.categories',
        ['profile'=> Auth::user(), 'list'=>$categories, 'parents'=>$parents, 'name' => $name]);
    }

    /**
     *  Display a listing data
     * @return View
     */
    public function create()
    {
        $categories = Category::paginate(10);
        $parents = Category::where('parent_id', null)->get();
        return view('product::admin.body.categories', ['list'=>$categories, 'parents'=>$parents]);
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
                'description' => 'required',
                'active' => 'required'
            ]);
    
            $status = false;
            $data = $request->all();
            $category = new Category();
            $category->title = $request->title;
            $category->image_source = $request->image_source;
            $category->description = $request->description;
            $category->active = $request->active;
            $category->parent_id = $request->parent_id;
            $status = $category->save();
            
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
            $rs = Category::where('id', $id)->first();
            return response()->json([
                'success' => true,
                'id'=>$id,
                'result' => $rs
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
            $status = Category::where('id', $id)->update($request->except(['_token']));
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
            $status = Category::where('id', $id)->delete();
            return response()->json(['success' => $status]);
        } catch (\Throwable $th) {
            return response()->json(['success' => false, 'msg'=> $th->getMessage()]);
        }
    }
}
