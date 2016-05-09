<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::auth();

Route::get('/', 'PagesController@landing');

Route::get('/cars', 'CarController@index');
Route::get('/car/{car}/rent-history', 'CarController@rentHistory');
Route::post('/car/{car}/upload-image', 'CarController@uploadImage');
Route::get('/car/{car}/edit-cover-photo', 'CarController@editCoverPhoto');
Route::post('/car/{car}/store-cover-photo', 'CarController@storeCoverPhoto');
Route::resource('car', 'CarController', ['except' => ['index']]);

Route::get('/rent/{car}/create', 'RentController@create');
Route::post('/rent/{car}', 'RentController@store');
Route::get('/rent/{rent}/car-tracking', 'RentController@carTracking');

Route::get('/user/{user}/rent-history', 'UserController@rentHistory');

Route::post('/car-tracking', 'CarTrackingController@store');
