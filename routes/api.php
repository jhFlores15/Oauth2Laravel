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
        Route::post('signup', 'Api\AuthController@signup')->middleware('isAdmin');
        Route::put('update/{id}', 'Api\AuthController@update')->middleware('isAdmin');

    });
});

Route::group(['middleware' => 'auth:api'], function() {


    //////////TODOS
    Route::resource('encuestas/existencia','Api\EncuestaExistenciaController')->only(['edit']);
    Route::resource('clientes','Api\ClienteController')->only(['show']); // ver cliente
    Route::resource('encuestas','Api\EncuestaController')->only(['show']);
    Route::resource('marcas','Api\MarcaController')->only(['show']);
    Route::get('autorizadores','Api\AutorizadorController@index');

    ////////////ADMIN
    //Route::resource('clientes','Api\ClienteController')->only(['index','store','update','destroy'])->middleware('isAdmin');
     Route::delete('clientes','Api\ClienteController@destroy')->middleware('isAdmin'); 
     Route::get('clientes','Api\ClienteController@index')->middleware('isAdmin');

    Route::post('clientes/activos','Api\ClienteController@activos')->middleware('isAdmin');
    Route::get('clientes/activos/export','Api\ClienteController@exportActivos')->middleware('isAdmin');


    Route::resource('encuestas','Api\EncuestaController')->only(['index','store','update','destroy'])->middleware('isAdmin');
    Route::resource('marcas','Api\MarcaController')->only(['store','update','destroy'])->middleware('isAdmin');
    Route::resource('regiones','Api\RegionController')->only(['index','store','show','update','destroy'])->middleware('isAdmin');
    Route::resource('comunas','Api\ComunaController')->only(['index','store','show','update','destroy'])->middleware('isAdmin');
    Route::resource('categorias','Api\CategoriaController')->only(['store','update','destroy'])->middleware('isAdmin');
    //Route::post('clientes/file','Api\ClienteController@file')->name('clientes.file')->middleware('isAdmin');
    Route::resource('encuestas/clientes','Api\EncuestaClienteController')->only(['store','show','update','destroy'])->middleware('isAdmin');   
    Route::post('encuestas/clientes/{encuesta}','Api\EncuestaClienteController@file')->middleware('isAdmin');     
    Route::get('encuesta/clientes/{encuesta}','Api\EncuestaClienteController@clientes')->middleware('isAdmin'); 
    Route::get('encuesta/clientes/No/{encuesta}','Api\EncuestaClienteController@clientesNo')->middleware('isAdmin');
    Route::put('encuesta/clientes/iniciar/{encuesta}','Api\EncuestaClienteController@iniciar')->middleware('isAdmin');
    Route::put('encuesta/clientes/terminar/{encuesta}','Api\EncuestaClienteController@terminar')->middleware('isAdmin');
    Route::get('encuesta/cliente/export/{encuesta_id}','Api\EncuestaClienteController@exportEncuestaCliente')->middleware('isAdmin');
    Route::get('tipos_productos', 'Api\TipoProductoController@index')->middleware('isAdmin');
    Route::get('tipos_encuesta', 'Api\TipoEncuestaController@index')->middleware('isAdmin');
    Route::get('administradores','Api\UserController@administradores')->middleware('isAdmin');
    Route::get('vendedores','Api\UserController@vendedores')->middleware('isAdmin');
    Route::post('usuarios','Api\UserController@file')->name('usuarios.file')->middleware('isAdmin');
    Route::get('usuarios/{user}','Api\UserController@user')->middleware('isAdmin');
    Route::delete('usuarios/{user}','Api\UserController@destroy')->middleware('isAdmin');
    Route::get('encuestas/existencia/Admin/N/{encuesta_id}','Api\EncuestaExistenciaAdminController@index_no_encuestados')->middleware('isAdmin');
     Route::get('encuestas/existencia/Admin/N/{encuesta_id}/export','Api\EncuestaExistenciaAdminController@exportEncuestaNoExistencia')->middleware('isAdmin');
    Route::get('encuestas/existencia/Admin/Y/{encuesta_id}','Api\EncuestaExistenciaAdminController@index_encuestados')->middleware('isAdmin');
    Route::get('encuestas/existencia/Admin/export/{encuesta_id}','Api\EncuestaExistenciaAdminController@exportEncuestaExistencia')->middleware('isAdmin');


    /////////////VENDEDOR
    Route::get('encuesta/vendedor','Api\EncuestaController@index_vendedor')->middleware('isVendedor');
    Route::get('encuestas/existencia/N/{encuesta_id}','Api\EncuestaExistenciaController@index_no_encuestados')->middleware('isVendedor');
    Route::get('encuestas/existencia/Y/{encuesta_id}','Api\EncuestaExistenciaController@index_encuestados')->middleware('isVendedor');
    Route::get('encuestas/cli_marca/{cliente_id}/{encuesta_id}','Api\ClienteMarcaController@index')->middleware('isVendedor');
    Route::get('encuestas/cli_marca_s/{cliente_id}/{marca_id}','Api\ClienteMarcaController@show')->middleware('isVendedor');
    Route::resource('encuestas/existencia','Api\EncuestaExistenciaController')->only(['store', 'update'])->middleware('isVendedor');
    Route::get('encuestas/clientess/{encuesta}/','Api\EncuestaClienteVendedorController@index')->middleware('isVendedor');
    Route::put('encuestas/clientes/{encuesta}/{cliente}','Api\EncuestaClienteVendedorController@update')->middleware('isVendedor');
    Route::get('encuestas/clientes/{encuesta}/{cliente}','Api\EncuestaClienteVendedorController@show')->middleware('isVendedor');
    Route::resource('encuestas/precio','Api\EncuestaPrecioController')->only(['store','update'])->middleware('isVendedor');
    Route::resource('notas_credito','Api\NotaCreditoController')->only(['store','update'])->middleware('isVendedor');



});

