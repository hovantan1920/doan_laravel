<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['prefix' => 'products'], function () {

    // Route::get('byCategory', 'API\ProductController@byCategory');
    // Route::get('hotSelling', 'API\ProductController@hotSelling');
    // Route::get('hotNew', 'API\ProductController@hotNew');
    // Route::get('search', 'API\ProductController@search');
    // Route::get('detail', 'API\ProductController@detail');
});

Route::group(['prefix' => 'categories'], function () {
    Route::get('/', 'Api\CategoryController@index');
});

Route::group(['prefix' => 'groups'], function () {
    Route::get('/', 'Api\ProductGroupController@index');
});

Route::group(['prefix' => 'brands'], function () {
    Route::get('/', 'Api\BrandController@index');
});