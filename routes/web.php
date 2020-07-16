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

Route::get('/', 'Controller@index');

Route::group(['prefix' => '/cart.html'], function () {
    Route::get('/', 'Controller@cart');
    Route::get('products', 'Controller@cartProducts');
    Route::get('price-total', 'Controller@cartPriceTotal');
    Route::get('related', 'Controller@cartRelated');
    Route::get('remove', 'Controller@carRemove');
    Route::get('complete', 'Controller@complete');
});

Route::get('/cart-checkout.html', 'Controller@cartCheckout');
Route::get('/cart-complete.html', 'Controller@cartComplete');
Route::get('/search.html', 'Controller@search');

Route::get('/{slug}.html', 'Controller@pages');


// Route::group(['prefix' => 'cus'], function () {
//     Route::get('/', 'CustomerAccountController@pageLogin')  
//         ->name('cus-login')->middleware('cus.logout');
//     Route::get('register', 'CustomerAccountController@pageRegister')
//         ->name('cus-register')->middleware('cus.logout');
//     Route::get('profile', 'CustomerAccountController@pageProfile')
//         ->name('cus-profile')->middleware('cus.login');

//     Route::get('logout', 'CustomerAccountController@logoutAccount')->name('cus-logout');

//     Route::resource('cus-handle', 'CustomerAccountController');
//     Route::get('confirm/{mytoken?}/{id?}', 'CustomerAccountController@confirmEmail');
//     Route::get('sendMail', 'CustomerAccountController@sendMailReset');
//     Route::get('resetPass/{myToken?}/{email?}', 'CustomerAccountController@resetPassword');
// });

Route::group(['prefix' => 'admin/account', 'middleware'=>'admin.logout'], function () {
    Route::get('/', 'Admin\AdminAccountController@pageLogin')->name('admin-login');
    Route::get('forget', 'Admin\AdminAccountController@pageForget')->name('admin-forget');
    Route::get('logout', 'Admin\AdminAccountController@logout')->name('admin-logout');
    Route::get('resetpassword/{myToken?}/{email?}', 'Admin\AdminAccountController@pageResetPass');
    Route::resource('handleadmin', 'Admin\AdminAccountController');
});

//Router page admin
Route::group(['prefix'=>'admin', 'middleware'=>'admin.login'], function(){
    Route::get('/', 'Admin\AdminController@home')->name('cooladmin');
    Route::group(['prefix'=>'user'], function(){
        Route::get('/', 'Admin\AdminController@user');
        Route::get('roles', 'Admin\AdminController@roles');
        Route::get('permissions', 'Admin\AdminController@permissions');
    });

    //Route for ajax:
    Route::group(['prefix'=>'ajax', 'middleware'=>'admin.login'], function(){
        Route::resource('admin-users', 'Admin\UserController');
    });
});