<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Login
Route::get('/login', 'PassportController@login')->name('login');
Route::post('/login', 'PassportController@login');

//Hotels
Route::get('/hotels/{id}', 'HotelController@getHotelDetails');

//Rooms
Route::get('/rooms', 'RoomController@index');
Route::get('/rooms/{id}', 'RoomController@show');

//Room types
Route::get('/room_types', 'RoomTypeController@index');
Route::get('/room_types/{id}', 'RoomTypeController@show');

//Prices
Route::get('/prices', 'PriceController@index');
Route::get('/prices/{id}', 'PriceController@show');

//Booking
Route::resource('/bookings', 'BookingController');

Route::group(['middleware' => 'auth:api'], function () {
    //Hotel
    Route::put('/hotels/{id}', 'HotelController@updateHotelDetails');

    //Rooms
    Route::post('/rooms', 'RoomController@store');
    Route::put('/rooms/{id}', 'RoomController@update');
    Route::delete('/rooms/{id}', 'RoomController@destroy');

    //Room types
    Route::post('/room_types', 'RoomTypeController@store');
    Route::put('/room_types/{id}', 'RoomTypeController@update');
    Route::delete('/room_types/{id}', 'RoomTypeController@destroy');

    //prices
    Route::post('/prices', 'PriceController@store');
    Route::put('/prices/{id}', 'PriceController@update');
    Route::delete('/prices/{id}', 'PriceController@destroy');

    Route::post('/upload', 'UtiltiyController@upload');

});

