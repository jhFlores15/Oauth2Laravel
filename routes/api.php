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
    //Route::resource('familia','Api\FamiliaCarozziController');
    Route::resource('clientes','Api\ClienteController');
    Route::post('clientes/file','Api\ClienteController@file')->name('clientes.file');
    Route::resource('encuestas','Api\EncuestaController');
    Route::get('encuesta/vendedor','Api\EncuestaController@index_vendedor');
    Route::resource('encuestas/clientes','Api\EncuestaClienteController');
    Route::post('encuestas/clientes/{encuesta}','Api\EncuestaClienteController@file');
    Route::get('encuesta/clientes/{encuesta}','Api\EncuestaClienteController@clientes');
   

    Route::get('tipos_encuesta', 'Api\TipoEncuestaController@index');
    Route::get('administradores','Api\UserController@administradores');
    Route::get('vendedores','Api\UserController@vendedores');
    Route::get('usuarios/{user}','Api\UserController@user');
    Route::post('usuarios','Api\UserController@file')->name('usuarios.file');
    Route::delete('usuarios/{user}','Api\UserController@destroy');


    /////////////vendedor/////
     Route::put('encuestas/clientes/{encuesta}/{cliente}','Api\EncuestaClienteVendedorController@update');
     Route::get('encuestas/clientes/{encuesta}/{cliente}','Api\EncuestaClienteVendedorController@show');
     Route::get('encuestas/cliente/{encuesta}','Api\EncuestaClienteVendedorController@index');


});

