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
    return view('welcome');
});

Route::get('/dash', function () {
    return view('dashboard.index');
});

Auth::routes();
Auth::routes(['verify' =>true]);

Route::get('/home',	'HomeController@index')->name('home')->middleware('stage');
//Route::get('/home', 'HomeController@index')->name('home');

//Contact Addresses
Route::get('/contacts/{user:slug}', 'ContactController@index');
Route::post('/contacts/{user:slug}', 'ContactController@post');
Route::put('/contacts/{contact:id}', 'ContactController@update');
Route::delete('/contacts/{contact:id}', 'ContactController@destroy');

//Business Physical location (address)
Route::get('/buslocations/{user:slug}', 'BuslocationController@index');
Route::post('/buslocations/{user:slug}', 'BuslocationController@post');
Route::put('/buslocations/{buslocation:id}', 'BuslocationController@update');
Route::delete('/buslocations/{buslocation:id}', 'BuslocationController@destroy');

//fleet information
Route::get('/alltrailers', 'FleetController@alltrailers');
Route::get('/fleets/{user:slug}', 'FleetController@index');
Route::post('/fleets/{user:slug}', 'FleetController@post');
Route::put('/fleets/{fleet:id}', 'FleetController@update');
Route::delete('/fleets/{fleet:id}', 'FleetController@destroy');


Route::get('/organisation-contacts', 'RegistrationController@show');
Route::get('/organisation-buslocations', 'RegistrationController@buslocations');
Route::get('/organisation-fleets', 'RegistrationController@fleets');
Route::get('/dashboard/{user:slug}','DashboardController@show');
