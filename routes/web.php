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
    return view('contenido/contenido');
});

Route::get('rol','RolesController@index');
Route::post('rol/registrar','RolesController@store');
Route::put('rol/actualizar','RolesController@update');
Route::post('rol/eliminar','RolesController@destroy');

Route::get('sucursal','SucursalesController@index');
Route::post('sucursal/registrar','SucursalesController@store');
Route::put('sucursal/actualizar','SucursalesController@update');
Route::post('sucursal/eliminar','SucursalesController@destroy');

Route::get('selectTenan', 'TenanController@getTenan');