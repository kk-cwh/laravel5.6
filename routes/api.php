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

Route::post('/login', 'Admin\UserController@login')->name('login');

Route::middleware('auth:api')->namespace('Admin')->group(function (){
    Route::get('/users','UserController@index');
    Route::get('/user_info','UserController@userInfo');
    Route::get('/store','UserController@store');
    Route::get('/update','UserController@update');
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
