<?php

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

Route::get('/', 'PagesController@homepage');

Route::get('/search', 'CarController@search');
Route::get('/car/{car}/rent-history', 'CarController@rentHistory');
Route::post('/car/{car}/upload-photo', 'CarController@uploadPhoto');
Route::post('/car/{car}/store-cover-photo', 'CarController@storeCoverPhoto');
Route::delete('/car/photo/{carPhoto}', 'CarController@deletePhoto');
Route::resource('car', 'CarController');

Route::get('/rent/{rent}', 'RentController@show');
Route::get('/rent/{rent}/edit', 'RentController@edit');
Route::get('/rent/{car}/create', 'RentController@create');
Route::post('/rent/{car}', 'RentController@store');
Route::patch('/rent/{rent}', 'RentController@update');

Route::get('/user', 'UserController@index');
Route::get('/user/{user}', 'UserController@show');
Route::get('/user/{user}/edit', 'UserController@edit');
Route::put('/user/{user}', 'UserController@update');
Route::get('/user/{user}/rent-history', 'UserController@rentHistory');

Route::post('/car-tracking', 'CarTrackingController@store');
Route::get('/rent/{rent}/car-tracking', 'CarTrackingController@rent');
Route::get('/car-tracking/{car}', 'CarTrackingController@show');
