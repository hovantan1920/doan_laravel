<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\AjaxPostRequestUser;
use App\User;
use App\Roles;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AjaxPostRequestUser $request)
    {
        $status     = true;
        $action     = $request->action;
        $id         = $request->id;
        $username   = $request->username;
        $password   = $request->password;
        $email      = $request->email;
        $roles_id   = $request->role;

        $model = new User();

        $password_default = "123456";
        $paginate         = 10;

        switch($action){
            case "insert":
                $status = $model->myInsert($username, $password_default, $email, $roles_id);
            break;
            case "update":
                $status = $model->myUpdate($id, $username, $password_default, $email, $roles_id);
            break;
            case "get-list":
                $model= User::all();
                $roles = Roles::all()->toArray();
                return view('admin.ajax.user-bodylist', ['list'=>$model, 'roles'=>$roles]);  
            break;
            case "find-one":
                return $model->myFindOne($id)->toJson();
                die();
            break;
        }

        if($status){
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
