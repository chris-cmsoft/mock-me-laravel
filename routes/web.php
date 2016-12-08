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

Route::any('/mockme/{api_key}/{url}', "MockMeController@mockme")->middleware('cors');

Route::pattern('url', '[a-zA-Z0-9-/]+');

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
        Route::get('/{api}/invite', 'ApiController@findInvitee')->name('api-invite');
        Route::post('/{api}/invite', 'ApiController@invite');
        Route::delete('/{api}', 'ApiController@destroy')->name('api-delete');

        Route::group(['prefix' => '{api}/route'], function() {

            Route::get('/create', "RouteController@create")->name('route-create');
            Route::post('/create', "RouteController@store");
            Route::get('/{route}', "RouteController@show")->name('route-view');
            Route::get('/{route}/update', "RouteController@edit")->name('route-update');
            Route::put('/{route}/update', "RouteController@update");
            Route::delete('/{route}', "RouteController@destroy")->name('route-delete');

        });

    });

});
