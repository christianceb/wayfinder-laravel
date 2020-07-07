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

Route::get('/', function() {
    return view('welcome');
});

Route::resource('/events', 'EventController');

// Route::get('/events', 'EventController@index')->name('home');
// Route::post('/events', 'EventController@store');
// Route::get('/events/create', 'EventController@create');
// Route::get('/events/{events}', 'EventController@show');
// Route::get('/events/{events}/edit', 'EventContoller@edit');
// Route::put('/events/{events}', 'EventController@update');
// Route::patch('/events/{events}', 'EventController@update');
// Route::delete('/events/{events}', 'EventController@destroy');
