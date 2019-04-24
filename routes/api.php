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

Route::group(['prefix' => 'auth'], function () {
    Route::post('login', 'Api\AuthController@login');
    
  
    Route::group(['middleware' => 'auth:api'], function() {
        Route::post('logout', 'Api\AuthController@logout');
        // Route::get('profile', 'Api\AuthController@profile');
        Route::post('signup', 'Api\AuthController@signup');
        Route::put('update/{id}', 'Api\AuthController@update');

    });
});

Route::group(['middleware' => 'auth:api'], function() {
    Route::resource('regiones','Api\RegionController');
    Route::resource('comunas','Api\ComunaController');
    Route::resource('localidades','Api\LocalidadController');
    Route::resource('familia','Api\FamiliaCarozziController');

    Route::get('administradores','Api\UserController@administradores')->name('user.administradores');
    Route::get('vendedores','Api\UserController@vendedores')->name('user.vendedores');

});

