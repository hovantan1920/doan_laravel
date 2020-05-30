<?php

namespace App\Http\Controllers\Admin;

use App\Categories;
use App\Gallerys;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Roles;
use App\Permissions;
use App\Products;

class AdminController extends Controller
{
    private $name = "";

    public function home()
    {
        $name = "home";
        return view('admin.home',['profile'=> Auth::user(), 'name' => $name]);
    }

    public function user(){
        $user  = User::all()->toArray();
        $roles = Roles::all()->toArray();
        $name  = "users";
        return view('admin.user',
        ['profile'=> Auth::user(), 'list'=>$user, 'roles'=>$roles, 'name' => $name]);
    }

    public function roles(){
        $roles = Roles::all()->toArray();
        $name  = "users";
        return view('admin.roles',['profile'=> Auth::user(), 'list'=>$roles, 'name' => $name]);
    }

    public function permissions(){
        $permissions = Permissions::all()->toArray();
        $name        = "users";
        return view('admin.permissions',
        ['profile'=> Auth::user(), 'list'=>$permissions, 'name' => $name]);
    }
}
