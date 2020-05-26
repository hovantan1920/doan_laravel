<?php

namespace Modules\Product\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

//Auth
use Illuminate\Support\Facades\Auth;
//Model
use Modules\Product\Entities\ProductGroup;

class ProductGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $name       = "groups";
        $data = ProductGroup::paginate(10);
        return view('product::admin.groups',
        ['profile'=> Auth::user(), 'list'=>$data, 'name' => $name]);
    }

    /**
     *  Display a listing data
     * @return View
     */
    public function create()
    {
        $data = ProductGroup::paginate(10);
        return view('product::admin.body.groups', ['list'=>$data]);
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
                'index' => 'required|integer'
            ]);
    
            $status = false;
            $data = $request->all();
            $model = new ProductGroup();
            $model->title = $request->title;
            $model->description = $request->description;
            $model->index = $request->index;
            $status = $model->save();
            
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
            $rs = ProductGroup::where('id', $id)->first();
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
            $status = ProductGroup::where('id', $id)->update($request->except(['_token']));
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
            $status = ProductGroup::where('id', $id)->delete();
            return response()->json(['success' => $status]);
        } catch (\Throwable $th) {
            return response()->json(['success' => false, 'msg'=> $th->getMessage()]);
        }
    }
}
