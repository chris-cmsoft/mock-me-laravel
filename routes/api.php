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

Route::pattern('url', '[a-zA-Z0-9-/]+');

Route::group(['namespace' => 'Api'], function() {

    Route::post('/login', 'AuthController@login');
    Route::post('/register', 'AuthController@register');
    Route::post('/logout', 'AuthController@logout')->middleware('auth.api');

    Route::group(['middleware' => 'auth.api'], function() {

        Route::get('/apis', 'ApiController@index');

    });

});

Route::get('/mockme/{api}/{url?}', function (Request $request) {
    dd('asd');
});
