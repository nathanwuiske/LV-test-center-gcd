<?php

Route::get('/', 'HomeController@index')->name('home');
/*
Route::get('/', function () {
    return view('home');
}); */

Auth::routes();
/* Routes to "view all" popular and newest vouchers */
Route::get('/popular_all', 'VoucherPageController@popular_all');
Route::get('/newest_all', 'VoucherPageController@newest_all');


Route::get('/addfavourite', 'HomeController@addfavourite');
Route::get('/removefavourite', 'HomeController@removefavourite');
Route::get('/search', 'HomeController@search');
Route::get('/filter', 'HomeController@filter');
Route::view('/advertise', 'advertise')->name('advertise');
Route::view('/privacy', 'privacy')->name('privacy');
Route::view('/terms', 'terms')->name('terms');
Route::get('/vouchers', 'VoucherPageController@index')->name('vouchers');
Route::get('/contact', 'ContactController@create')->name('contact');
Route::post('/contact', 'ContactController@store')->name('contact.store');
//Route::view('/favourites', 'favourites')->name('favourites');
Route::get('/favourites', 'FavouriteController@index')->name('favourites');
Route::get('/account', 'AccountController@index')->name('account');
Route::get('/adminhome', 'AdminHomeController@index')->name('adminhome');
Route::get('/home', 'HomeController@index')->name('home');
//Route::get('/{any}', 'HomeController@index')->where('any', '.*');