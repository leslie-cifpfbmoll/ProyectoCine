<?php

use Illuminate\Support\Facades\Route;

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


Auth::routes();
Auth::routes(['verify' => true]);
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', 'welcomeController@index')->name('welcome');

Route::namespace('Admin')->prefix('admin')->middleware(['can:administrar'])->name('admin.')->group(function() {
    Route::resource('users', 'UserController', ['except' => ['show']]);
    Route::resource('generos', 'GenerosController', ['except' => ['show']]);
    Route::resource('salas', 'SalasController', ['except' => ['show']]);
    Route::resource('directores', 'DirectoresController', ['except' => ['show']]);
    Route::resource('precios', 'PreciosController', ['except' => ['show']]);
    Route::resource('administrar', 'AdministrarController', ['only' => ['index']]);
    Route::get('administrar/usuarios', 'AdministrarController@getUsuarios')->name('administrar.getUsuarios');
    Route::get('administrar/peliculas', 'AdministrarController@getPeliculas')->name('administrar.getPeliculas');
    Route::get('administrar/directores', 'AdministrarController@getDirectores')->name('administrar.getDirectores');
    Route::get('administrar/salas', 'AdministrarController@getSalas')->name('administrar.getSalas');
    Route::get('carteleras/get-horarios', 'CartelerasController@getHorarios')->name('carteleras.getHorarios');
    Route::get('carteleras/get-duracion', 'CartelerasController@getDuracion')->name('carteleras.getDuracion');
   
});
Route::namespace('Admin')->prefix('admin')->name('admin.')->group(function() {
Route::resource('peliculas', 'PeliculasController', ['except' => ['show']]);
    Route::resource('carteleras', 'CartelerasController', ['except' => ['show']]);
    Route::resource('reservas', 'ReservasController', ['except' => ['show', 'index']]);
    Route::resource('perfil', 'PerfilController', ['except' => ['show']]);
    Route::post('perfil', 'UserController@update_avatar');
    Route::post('/reservas/index/{id}/{horario_id}', 'ReservasController@index')->name('reservas.index');
    Route::post('/reservas/pagar/{id}', 'ReservasController@pagar')->name('reservas.pagar');
    Route::post('/reservas/reservar/{id}/{cantidad}/{horario}', 'ReservasController@reservar')->name('reservas.reservar');
    Route::get('carteleras/get-aforo', 'CartelerasController@getAforo')->name('carteleras.getAforo');
     Route::resource('carteleras', 'CartelerasController', ['except' => ['show']]);
});



