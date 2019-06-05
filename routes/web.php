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
Route::get('/', 'UserController@welcome')->name('home');
// Route::get('/', function () {
//     return view('welcome');
// })->name('home');


Route::get('administradores', 'UserController@administradores')->name('user.administradores');
Route::get('vendedores', 'UserController@vendedores')->name('user.vendedores');
Route::get('regiones', 'RegionController@index')->name('region.index');
Route::get('comunas', 'ComunaController@index')->name('comuna.index');
Route::get('clientes', 'ClienteController@index')->name('cliente.index');
Route::get('encuestas/vendedor','EncuestaController@index_vendedor');
Route::get('encuestas', 'EncuestaController@index')->name('encuesta.index');
Route::get('encuestas/create', 'EncuestaController@create')->name('encuesta.create');
Route::get('encuestas/{encuesta_id}/edit', 'EncuestaController@edit');


//////////////////////vendedor////////////7
Route::get('encuestas/clientes/{encuesta}/{cliente}/edit','EncuestaClienteVendedorController@edit')->name('encuestas.clientes.edit');
Route::get('encuestas/clientes/{encuesta}','EncuestaClienteVendedorController@index');
Route::get('encuestas/E/P/{encuesta}','EncuestaExistenciaController@index');
Route::get('encuestas/E/{encuesta}/{cliente_id}/create','EncuestaExistenciaController@create');
Route::get('encuestas/E/{encuesta}/{cliente_id}/edit','EncuestaExistenciaController@edit');
Route::get('encuestas/E/{encuesta}/','EncuestaExistenciaController@show'); //Admin
Route::get('excel/down','EncuestaExistenciaController@excelDownload'); //Admin


Route::get('encuestas/P/{encuesta}/{cliente_id}/create','EncuestaPrecioController@create');
Route::get('encuestas/P/{encuesta}/{cliente_id}/edit','EncuestaPrecioController@edit');
Route::get('encuestas/P/{encuesta}/','EncuestaPrecioController@show'); //Admin
Route::get('notas_credito/create','NotaCreditoController@create'); //Admin

Route::resource('encuesta/clientes','EncuestaClienteController');