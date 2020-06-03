<?php

namespace Modules\Product\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

//Auth
use Illuminate\Support\Facades\Auth;
//Model
use Modules\Product\Entities\Brand;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $name       = "brands";
        $list = Brand::paginate(10);
        return view('product::brands',
        ['profile'=> Auth::user(), 'list'=>$list, 'name' => $name]);
    }

    /**
     *  Display a listing data
     * @return View
     */
    public function create()
    {
        $list = Brand::paginate(10);
        return view('product::body.brands', ['list'=>$list]);
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
            ]);
    
            $status = false;
            $model = new Brand();
            $model->title = $request->title;
            $model->image_source = $request->image_source;
            $model->description = $request->description;
            $model->country = $request->country;
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
            $rs = Brand::where('id', $id)->first();
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
            $status = Brand::where('id', $id)->update($request->except(['_token']));
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
            $status = Brand::where('id', $id)->delete();
            return response()->json(['success' => $status]);
        } catch (\Throwable $th) {
            return response()->json(['success' => false, 'msg'=> $th->getMessage()]);
        }
    }
}
