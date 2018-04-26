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
//后台管理登录 api
Route::post('/login', 'Admin\UserController@login')->name('login');
//后台管理相关接口api
Route::middleware('auth:api')->namespace('Admin')->group(function (){

    Route::get('/users','UserController@index');
    Route::get('/user_info','UserController@userInfo');
    Route::post('/users/store','UserController@store');
    Route::put('/users/update','UserController@update');

    Route::get('/categories','CategoryController@index');
    Route::get('/categories/show','CategoryController@show');
    Route::post('/categories/store','CategoryController@store');
    Route::put('/categories/update','CategoryController@update');

    Route::get('/tags','TagController@index');
    Route::get('/tags/show','TagController@show');
    Route::post('/tags/store','TagController@store');
    Route::put('/tags/update','TagController@update');

    Route::get('/links','LinkController@index');
    Route::get('/links/show','LinkController@show');
    Route::post('/links/store','LinkController@store');
    Route::put('/links/update','LinkController@update');
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


/**
 * 博客前台首页相关路由api
 */
// Route::group(function () {
//     Route::get('/_articles', 'HomeController@articles');
//     Route::get('/_articles/{id}', 'HomeController@articleDetail');
//     Route::get('/_types', 'HomeController@types');
//     Route::get('/_tags', 'HomeController@tags');
//     Route::get('/_archives', 'HomeController@archives');
// });

