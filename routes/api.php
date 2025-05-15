<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
//rutas para nuestra api
Route::get('articulo', 'App\Http\Controllers\ArticuloController@todosArticulos')->name('articulo');
Route::get('articulo/{id}', 'App\Http\Controllers\ArticuloController@articuloId')->name('articuloId');
Route::post('nuevo', 'App\Http\Controllers\ArticuloController@nuevoArticulo')->name('nuevo');
Route::put('actualizar/{id}', 'App\Http\Controllers\ArticuloController@actualizarArticulo')->name('actualizar');
Route::delete('eliminar/{id}', 'App\Http\Controllers\ArticuloController@eliminarArticulo')->name('eliminar');
Route::get('usuarios', 'App\Http\Controllers\MicroservicioController@microservicio')->name('usuarios');
