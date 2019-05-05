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