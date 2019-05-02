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

// Route::get('login', 'UserController@login')->name('login');
Route::get('administradores', 'UserController@administradores')->name('user.administradores');
Route::get('vendedores', 'UserController@vendedores')->name('user.vendedores');
Route::get('regiones', 'RegionController@index')->name('region.index');
Route::get('comunas', 'ComunaController@index')->name('comuna.index');
Route::get('localidades', 'LocalidadController@index')->name('localidad.index');
Route::get('clientes', 'ClienteController@index')->name('cliente.index');
Route::resource('encuestas','EncuestaController');
// Route::get('encuestas', 'EncuestaController@index')->name('encuesta.index');
// Route::get('encuestas/{encuesta}', 'EncuestaController@show')->name('encuesta.show');
// Route::get('encuestas/create', 'EncuestaController@create')->name('encuesta.create');
