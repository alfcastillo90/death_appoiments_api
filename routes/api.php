<?php

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
//
Route::post('register','API\RegisterController@register');
Route::post('login','API\RegisterController@login');
Route::middleware('auth:api')->group(function(){
   Route::resource('countries','API\CountryController');
   Route::resource('cities','API\CityController');
   Route::resource('identification_types','API\IdentificationTypeController');
   Route::resource('victims','API\VictimController');
   Route::resource('appointments','API\AppointmentController');
});
//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});
