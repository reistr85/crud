<?php


Route::resource('/products', 'ProductController');
Route::get('/logout', 'LogoutController@index');

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
