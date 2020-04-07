<?php

namespace App\Http\Controllers;

use App\Categories;
use App\Gallerys;
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

    public function categories(){
        $name       = "categories";
        $categories = Categories::paginate(10);
        return view('admin.categories',
        ['profile'=> Auth::user(), 'list'=>$categories, 'name' => $name]);
    }
    
    public function products(){
        $products = Products::all()->toArray();
        $gallerys = Gallerys::all()->toArray();
        $name     = "products";
        return view('admin.products',
        ['profile'=> Auth::user(), 'list'=>$products, 'gallerys'=>$gallerys, 'name' => $name]);
    }
    
    public function gallerys(){
        $gallerys   = Gallerys::all()->toArray();
        $categories = Categories::all()->toArray();
        $name       = "gallerys";
        return view('admin.gallerys',
        ['profile'=> Auth::user(), 'list'=>$gallerys, 'categories'=>$categories, 'name' => $name]);
    }
    
    public function bookings(){
        $name  = "bookings";
        return view('admin.bookings',['profile'=> Auth::user(), 'name' => $name]);
    }
}
