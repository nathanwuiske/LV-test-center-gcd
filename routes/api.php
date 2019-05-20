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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Register resourceful routes with post, get, patch and delete requests
Route::apiResource('voucher', 'API\VoucherController');
Route::apiResource('tag', 'API\TagController');
Route::apiResource('vouchertag', 'API\VoucherTagController');
Route::apiResource('category', 'API\CategoryController');
Route::apiResource('vouchercategory', 'API\VoucherCategoryController');
Route::apiResource('archived', 'API\ArchivedController');

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