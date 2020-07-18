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

// Disable planned routes
Auth::routes([
    'register' => false,
    'reset' => false,
    'verify' => false
]);

Route::group(['middleware' => ['auth']], function () {
    Route::resource('/events', 'EventsController');
    Route::resource('/uploads', 'UploadsController');

    // Locations resource and then some
    Route::get('/locations/type/{type?}', 'LocationsController@byType')->name('locations.type');
    Route::resource('/locations', 'LocationsController');

    // Users collection has no capability to delete anything
    Route::resource('/users', 'UsersController', ['except' => ['destroy']]);
});
