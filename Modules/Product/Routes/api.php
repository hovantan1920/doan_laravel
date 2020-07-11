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

Route::group(['prefix' => 'collection'], function () {
    Route::group(['middleware' => 'auth:api'], function(){
        Route::post('/make', 'API\ProductCollectionController@make');
        Route::post('/get', 'API\ProductCollectionController@index');
        Route::post('/check', 'API\ProductCollectionController@check');
    });
});

Route::group(['prefix' => 'products'], function () {
    Route::get('/', 'API\ProductController@search');
    Route::get('get', 'API\ProductController@get');
    Route::get('gets', 'API\ProductController@gets');
    Route::get('suggest', 'API\ProductController@suggest');
    
    // Route::get('byCategory', 'API\ProductController@byCategory');
    // Route::get('hotSelling', 'API\ProductController@hotSelling');
    // Route::get('hotNew', 'API\ProductController@hotNew');
});

Route::group(['prefix' => 'categories'], function () {
    Route::get('/', 'Api\CategoryController@index');
    Route::get('/products', 'Api\CategoryController@products');
});

Route::group(['prefix' => 'groups'], function () {
    Route::get('/', 'Api\ProductGroupController@index');
});

Route::group(['prefix' => 'brands'], function () {
    Route::get('/', 'Api\BrandController@index');
});