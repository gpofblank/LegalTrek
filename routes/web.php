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

Route::get('/', function () {
	return redirect()->route('home');
});

Route::get('/home', 'HomeController@index')->name('home');

Route::post('/all', 'HomeController@store')->name('store_all');

Route::resource('/clients', 'ClientsController')->only(['index', 'show']);

Route::resource('/documents', 'DocumentsController')->only(['index', 'show']);

Route::resource('/events', 'EventsController')->only(['index', 'show']);

Route::resource('/matters', 'MattersController')->only(['index', 'show']);

Route::resource('/tasks', 'TasksController')->only(['index', 'show']);
