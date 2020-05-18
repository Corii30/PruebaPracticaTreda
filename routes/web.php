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

Route::get('tiendas', 'TiendasController@tienda')->name('tiendas');
Route::get('lstienda', 'TiendasController@index')->name('listaT');
Route::post('tiendas', 'TiendasController@store');
Route::put('tiendas/{id}', 'TiendasController@update');
Route::delete('tiendas/{id}', 'TiendasController@destroy');

