<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::prefix('product')->group(function() {
    Route::get('/', 'ProductController@index');
});

Route::group(['prefix'=>'admin', 'middleware'=>'admin.login'], function(){

    Route::get('categories', 'PageAdminController@pageCategories');
    Route::get('gallerys', 'PageAdminController@pageGallerys');
    Route::get('products', 'PageAdminController@pageProducts');

    //Route for ajax:
    Route::group(['prefix'=>'ajax', 'middleware'=>'admin.login'], function(){
        Route::resource('admin-categories', 'CategoryController');
    });
});

