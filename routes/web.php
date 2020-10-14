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
    return view('principal');
});



Route::get('persona','PersonasController@index'); 
Route::post('/persona/registrar','PersonasController@store'); 
Route::put('/persona/actualizar','PersonasController@update'); 
Route::post('/persona/eliminar','PersonasController@destroy');