<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
Route::get('generos', 'GenerosController@getAll')->name('getAllGeneros');
Route::post('generos', 'GenerosController@add')->name('addGenero');
Route::get('generos/{id}', 'GenerosController@get')->name('getGenero');
Route::post('generos/{id}', 'GenerosController@edit')->name('editGenero');
Route::delete('generos/{id}', 'GenerosController@delete')->name('deleteGenero');

Route::get('directores', 'DirectoresController@getAll')->name('getAllDirectores');
Route::post('directores', 'DirectoresController@add')->name('addDirector');
Route::get('directores/{id}', 'DirectoresController@get')->name('getDirector');
Route::post('directores/{id}', 'DirectoresController@edit')->name('editDirector');
Route::delete('directores/{id}', 'DirectoresController@delete')->name('deleteDirector');

Route::get('salas', 'SalasController@getAll')->name('getAllSalas');
Route::post('salas', 'SalasController@add')->name('addSala');
Route::get('salas/{id}', 'SalasController@get')->name('getSala');
Route::post('salas/{id}', 'SalasController@edit')->name('editSala');
Route::delete('salas/{id}', 'SalasController@delete')->name('deleteSala');

Route::get('carteleras', 'CartelerasController@getAll')->name('getAllCarteleras');
Route::post('carteleras', 'CartelerasController@add')->name('addCartelera');
Route::get('carteleras/{id}', 'CartelerasController@get')->name('getCartelera');
Route::post('carteleras/{id}', 'CartelerasController@edit')->name('editCartelera');
Route::delete('carteleras/{id}', 'CartelerasController@delete')->name('deleteCartelera');

Route::get('peliculas', 'PeliculasController@getAll')->name('getAllPeliculas');
Route::post('peliculas', 'PeliculasController@add')->name('addPelicula');
Route::get('peliculas/{id}', 'PeliculasController@get')->name('getPelicula');
Route::post('peliculas/{id}', 'PeliculasController@edit')->name('editPelicula');
Route::delete('peliculas/{id}', 'PeliculasController@delete')->name('deletePelicula');

Route::get('reservas', 'ReservasController@getAll')->name('getAllReservas');
Route::post('reservas', 'ReservasController@add')->name('addReserva');
Route::get('reservas/{id}', 'ReservasController@get')->name('getReserva');
Route::post('reservas/{id}', 'ReservasController@edit')->name('editReserva');
Route::delete('reservas/{id}', 'ReservasController@delete')->name('deleteReserva');