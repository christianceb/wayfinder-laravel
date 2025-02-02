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
    
    // Floor plans
    Route::get('/floors/building/{location?}', 'FloorsController@byBuilding')->name('floors.building');
    Route::get('/floors/dump', 'FloorsController@dump')->name('floors.dump');
    Route::resource('/floors', 'FloorsController');

    // Locations resource and then some
    Route::get('/uploads/byId/{upload?}', 'UploadsController@byId')->name('uploads.id');
    Route::get('/uploads/dump', 'UploadsController@dump')->name('uploads.dump');
    Route::resource('/uploads', 'UploadsController');

    // Locations resource and then some
    Route::get('/locations/type/{type?}', 'LocationsController@byType')->name('locations.type');
    Route::get('/locations/dump', 'LocationsController@dump')->name('locations.dump');
    Route::resource('/locations', 'LocationsController');

    // Users collection has no capability to delete anything
    Route::resource('/users', 'UsersController', ['except' => ['destroy']]);
});
