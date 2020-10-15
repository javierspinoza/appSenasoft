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

Route::get('tenan','TenanController@index');
Route::post('tenan/registrar','TenanController@store');
Route::put('tenan/actualizar','TenanController@update');
Route::post('tenan/eliminar','TenanController@destroy');

Route::get('persona','PersonasController@index');
Route::post('persona/registrar','PersonasController@store');
Route::put('persona/actualizar','PersonasController@update');
Route::post('persona/eliminar','PersonasController@destroy');
