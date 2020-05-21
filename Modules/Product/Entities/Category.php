<?php

namespace Modules\Product\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Category extends Model
{
    protected $table    = 'Categories';
    protected $fillable = ['id', 'title', 'descride', 'image', 'active', 'parent_id'];

    public static function myInsert($title, $descride, $image, $active, $parent_id){
        try {
            $obj = new static;
            $obj->title = $title;
            $obj->image = $image;
            $obj->active = (int) $active;
            $obj->parent_id = $parent_id;
            $obj->descride = $descride;
            $obj->save();
        } catch (\Throwable $th) {
            return false;
        }
        return true;
    }

    public static function myUpdate($id, $title, $descride, $image, $active, $parent_id){
        try {
            $obj = static::find($id);
            $obj->title    = $title;
            $obj->image = $image;
            $obj->active = $active;
            $obj->parent_id = $parent_id;
            $obj->descride = $descride;
            $obj->save(); 
        } catch (\Throwable $th) {
            return false;
        }
        return true;
    }

    public static function myDelete($id){
        try {
            $obj = static::find($id);
            $obj->delete();
        } catch (\Throwable $th) {
            return false;
        }
        return true;
    }

    public static function myFindOne($id){
        try {
            $obj = static::find($id);
            return $obj;
        } catch (\Throwable $th) {
            return null;
        }
    }

    public static function myGetList($paginate){
        try {
            $objs = static::paginate($paginate);
            return $objs;
        } catch (\Throwable $th) {
            return null;
        }
    }

    public static function myFilter($property, $value, $paginate){
        try {
            if($property != "none"){
                if($value != "normal"){
                    $objs = Category::orderBy( $property, $value)->paginate($paginate);
                }
                else{
                    $objs = Category::orderBy( $property, 'asc')->paginate($paginate);  
                }
            }
            else{
                $objs = Category::orderBy( 'id', 'desc')->paginate($paginate);
            }
        } catch (\Throwable $th) {
            return null;
        }

        return $objs;
    }
}


