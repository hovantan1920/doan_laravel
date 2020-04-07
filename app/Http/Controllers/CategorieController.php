<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Categories;

class CategorieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return redirect('admin/categories');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        index();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    //Func add
    public function store(Request $request)
    {
        $status = $request->validate([
            'action'  => 'required',
            'id'      => 'required',
            'title'   => 'required',
            'descride'=> 'required'
        ]);

        $action   = $request->action;
        $id       = $request->id;
        $title    = $request->title;
        $descride = $request->descride;
        
        switch($action){
            case "insert":
                $categorie = new Categories();
                $categorie->title    = $title;
                $categorie->descride = $descride;
                $status = $categorie->save();
                break;
            case "update":
                $categorie = Categories::find($id);
                $categorie->title    = $title;
                $categorie->descride = $descride;
                $status = $categorie->save(); 
                break; 
            case "delete":
                $categorie = Categories::find($id);
                $status    = $categorie->delete();
                break;       
            case "find-one":
                $categorie = Categories::find($id);
                return $categorie->toJson();
                die();
                break;  
            case "get-list":
                $categories = Categories::paginate(10);
                return view('admin.ajax.categories-bodylist', ['list'=>$categories]);    
                break; 
            case "filter-list":

                $property = $request->property;
                $value    = $request->value;

                if($property != "none"){
                    if($value != "normal"){
                        $categories = Categories::orderBy( $property, $value)->paginate(10);
                    }
                    else{
                        $categories = Categories::orderBy( $property, 'asc')->paginate(10);  
                    }
                }
                else{
                    $categories = Categories::orderBy( 'id', 'desc')->paginate(10);
                }
                return view('admin.ajax.categories-bodylist', ['list'=>$categories]);    
                break; 
        }
        
        if($status) {
            return response()->json(['success' => 'true']);
        }
        return response()->json(['success'=> 'false']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        index();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        index();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        index();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        index();
    }
}
