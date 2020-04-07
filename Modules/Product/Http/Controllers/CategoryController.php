<?php

namespace Modules\Product\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

//Request
use Modules\Product\Http\Requests\AjaxPostRequestCategory;

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
    public function store(AjaxPostRequestCategory $request)
    {
        $status = false;

        $action   = $request->action;
        $id       = $request->id;
        $title    = $request->title;
        $descride = $request->descride;

        $property = $request->property;
        $value    = $request->value;
        
        $category = new Category();
        $paginate = 10;
        
        switch($action){
            case "insert":
                $status = $category->myInsert($title, $descride);
                break;
            case "update":
                $status = $category->myUpdate($id, $title, $descride);
                break; 
            case "delete":
                $status    = $category->myDelete($id);
                break;       
            case "find-one":
                return $category->myFindOne($id)->toJson();
                die();
                break;  
            case "get-list":
                $list = $category->myGetList($paginate);
                return view('product::admin.ajax.categories-bodylist', ['list'=>$list]);    
                break; 
            case "filter-list":
                $list = $category->myFilter($property, $value, $paginate);
                return view('product::admin.ajax.categories-bodylist', ['list'=>$list]);    
                break; 
        }
        
        if($status) {
            return response()->json(['success' => 'true']);
        }
        return response()->json(['success'=> 'false']);
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
