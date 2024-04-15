<?php

use Illuminate\Support\Facades\Route;

Route::get('/', '\App\Http\Controllers\PaypalController@index');
Route::get('/create/{amount}', '\App\Http\Controllers\PaypalController@create');
Route::post('/complete', '\App\Http\Controllers\PaypalController@complete');
