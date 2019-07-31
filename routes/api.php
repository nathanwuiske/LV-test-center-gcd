<?php

use Illuminate\Http\Request;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Register resourceful routes with post, get, patch and delete requests
Route::apiResource('voucher', 'API\VoucherController');
//new user endpoint was created - where is the default one?
Route::apiResource('users', 'API\UserController');
Route::apiResource('tag', 'API\TagController');
Route::apiResource('vouchertag', 'API\VoucherTagController');
Route::apiResource('category', 'API\CategoryController');
Route::apiResource('vouchercategory', 'API\VoucherCategoryController');
Route::apiResource('archived', 'API\ArchivedController');
Route::apiResource('business', 'API\BusinessController');
Route::apiResource('location', 'API\LocationController');

/* Get all the tags and categories in a single endpoint */
Route::get('categoryall', 'API\CategoryController@categoryall');
Route::get('tagall', 'API\TagController@tagall');
Route::get('voucherall', 'API\VoucherController@voucherall');

Route::apiResource('redeem', 'API\RedeemController');

Route::get('metrics', 'MetricsController@metrics');


Route::get('findVoucher', 'API\VoucherController@search');

Route::group([
    'prefix' => 'auth'
], function () {
    Route::post('login', 'Auth\AuthController@login')->name('login');
    Route::post('register', 'Auth\AuthController@register');
    Route::post('forgot', 'Auth\ForgotPassController@sendEmail');
    Route::group([
      'middleware' => 'auth:api'
    ], function() {
        Route::get('logout', 'Auth\AuthController@logout');
        Route::get('user', 'Auth\AuthController@user');
        
    });
});