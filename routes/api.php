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

Route::post('/login', function (Request $request) {
    $data     = $request->all();
    $http     = new GuzzleHttp\Client;
    $response = $http->post(env("APP_URL") . 'oauth/token', [
        'form_params' => [
            'grant_type'    => 'password',
            'client_id'     => env("CLIENT_ID"),
            'client_secret' => env("CLIENT_SECRET"),
            'username'      => array_get($data, 'username'),
            'password'      => array_get($data, 'password'),
            'scope'         => '*',
        ],
    ]);

    return json_decode((string)$response->getBody(), true);
})->name('login');


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
