<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index');

Route::group(['prefix' => 'admin', 'middleware' => 'auth', 'namespace' => 'Admin'], function() {

    Route::group(['prefix' => 'api'], function() {

        Route::get('/', 'ApiController@index')->name('api-index');
        Route::get('/create', 'ApiController@create')->name('api-create');
        Route::post('/create', 'ApiController@store');
        Route::get('/{api}', 'ApiController@show')->name('api-view');
        Route::get('/{api}/update', 'ApiController@edit')->name('api-update');
        Route::put('/{api}/update', 'ApiController@update');
        Route::delete('/{api}', 'ApiController@destroy')->name('api-delete');

    });

});
