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

Route::get('/', function () {

    return view('/welcome');
});
Auth::routes();
Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home')->middleware('verified');
Route::get('/admin', function() {
    return 'you are admin';
})->middleware(['auth', 'auth.admin']);


Route::namespace('Admin')->prefix('admin')->middleware(['can:administrar'])->name('admin.')->group(function() {
    Route::resource('users', 'UserController', ['except' => ['show']]);
    Route::resource('generos', 'GenerosController', ['except' => ['show']]);
    Route::resource('peliculas', 'PeliculasController', ['except' => ['show']]);
    Route::resource('salas', 'SalasController', ['except' => ['show']]);
    Route::resource('directores', 'DirectoresController', ['except' => ['show']]);
    Route::resource('carteleras', 'CartelerasController', ['except' => ['show']]);
    
});



