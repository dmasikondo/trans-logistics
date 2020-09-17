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
    return view('index');
});

Route::get('/dash', function () {
    return view('dashboard.index');
});

Auth::routes();
Auth::routes(['verify' =>true]);

Route::get('/home',	'HomeController@index')->name('home')->middleware('stage');


//loads / consignments for carriage
Route::resource('loads','LoadController');
Route::get('/allcategories','LoadController@allcategories');
Route::get('/loads/{user:slug}', 'LoadController@index');
Route::post('/loads/{user:slug}', 'LoadController@store');
Route::get('/loads/{load:slug}/edit', 'LoadController@edit');
Route::put('/loads/{load:slug}', 'LoadController@update');
Route::delete('/loads/{load:slug}', 'LoadController@destroy');
Route::get('/loads/{load:slug}', 'LoadController@show');
Route::put('/loads/{load:slug}/private-visibility', 'LoadController@privateVisibility');
Route::put('/loads/{load:slug}/public-visibility', 'LoadController@publicVisibility');
Route::get('/loads/{load:slug}/new-freight-value', 'LoadController@newFreightValue');
Route::put('/loads/{load:slug}/distance-trailer', 'LoadController@distanceTrailer');
Route::get('loads','LoadController@index');

//vehicles in search of goods to ship
Route::post('/vehicles','VehicleController@store');
Route::get('/vehicles/create','VehicleController@create');
Route::get('/vehicles/{vehicle:slug}','VehicleController@show');
Route::get('/vehicles/{vehicle:slug}/edit','VehicleController@edit');
Route::put('/vehicles/{vehicle:slug}','VehicleController@update');
Route::delete('/vehicles/{vehicle:slug}','VehicleController@destroy');
Route::put('/vehicles/{vehicle:slug}/private-visibility', 'VehicleController@privateVisibility');
Route::put('/vehicles/{vehicle:slug}/public-visibility', 'VehicleController@publicVisibility');


// Bidding for shipments
Route::post('bids/{load:slug}', 'BidController@store');
Route::get('bids/{load:slug}/total-number', 'BidController@TotalBids');
Route::delete('bids/{load:slug}', 'BidController@destroy');


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


//director information
Route::get('/directors/{user:slug}', 'DirectorController@index');
Route::post('/directors/{user:slug}', 'DirectorController@post');
Route::put('/directors/{director:id}', 'DirectorController@update');
Route::delete('/directors/{director:id}', 'DirectorController@destroy');

//traderef information
Route::get('/traderefs/{user:slug}', 'TraderefController@index');
Route::post('/traderefs/{user:slug}', 'TraderefController@post');
Route::put('/traderefs/{traderef:id}', 'TraderefController@update');
Route::delete('/traderefs/{traderef:id}', 'TraderefController@destroy');

// bid for consignments

Route::get('/bids/{bid:slug}', 'BidController@show');

Route::get('/organisation-contacts', 'RegistrationController@show');
Route::get('/organisation-buslocations', 'RegistrationController@buslocations');
Route::get('/organisation-fleets', 'RegistrationController@fleets');
Route::get('/organisation-directors', 'RegistrationController@directors');
Route::get('/organisation-traderefs', 'RegistrationController@traderefs');
Route::get('/dashboard/{user:slug}','DashboardController@show');


//pages
Route::get('/about-us', function () {
    return view('/pages/about');
});
Route::get('/services', function () {
    return view('/pages/services');
});
Route::get('/contact-us', function () {
    return view('/pages/contact');
});
Route::get('/faq', function () {
    return view('/pages/faq');
});
Route::get('/freight-forwarding', function () {
    return view('/pages/freight-forwarding');
});
Route::get('/tracking-insurance', function () {
    return view('/pages/tracking-insurance');
});
Route::get('/terms', function () {
    return view('/pages/terms');
});

Route::get('/form', function () {
    return view('welcome');
});
Route::post('/send', 'EmailController@send');