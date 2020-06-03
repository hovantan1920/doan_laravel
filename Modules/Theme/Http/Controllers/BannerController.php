<?php

namespace Modules\Theme\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
//Auth
use Illuminate\Support\Facades\Auth;
//Model
use Modules\Theme\Entities\Banner;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $name       = "themes";
        $banners = Banner::paginate(10);
        return view('theme::banners',
        ['profile'=> Auth::user(), 'list'=>$banners, 'name' => $name]);
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $banners = Banner::paginate(10);
        return view('theme::body.banners', ['list'=>$banners]);
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
                'image_source' => 'required',
                'slogan' => 'required',
            ]);
    
            $status = false;
            $model = new Banner();
            $model->image_source = $request->image_source;
            $model->slogan = $request->slogan;
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
            $rs = Banner::where('id', $id)->first();
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
            $status = Banner::where('id', $id)->update($request->except(['_token']));
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
            $status = Banner::where('id', $id)->delete();
            return response()->json(['success' => $status]);
        } catch (\Throwable $th) {
            return response()->json(['success' => false, 'msg'=> $th->getMessage()]);
        }
    }
}
