<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Auth::routes();

Route::get('/Admin', 'LoginController@index')->middleware('auth');
Route::get('/Admin/logout', 'LoginController@logout');
Route::get('/Admin/successlogin', 'LoginController@successlogin');

Route::resource('/events', 'EventController');
Route::resource('/uploads', 'UploadsController');
Route::resource('/locations', 'LocationsController');

Route::get('/locations', 'LocationsController@index')->name('home');
Route::post('/locations', 'LocationsController@store');
Route::get('/locations /create', 'LocationsController@create');
Route::get('/locations /{locations}', 'LocationsController@show');
Route::get('/locations /{locations} /edit', 'LocationsController@edit');
Route::put('/locations /{locations}', 'LocationsController@update');
Route::patch('/locations /{locations}', 'LocationsController@update');
Route::delete('/locations /{locations}', 'LocationsController@destroy');