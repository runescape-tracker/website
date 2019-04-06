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

Route::get('/', 'WelcomeController@index');
Route::post('track', 'TrackingController@track');

Route::get('rs3/{rsn}', 'RS3ProfileController@index')
     ->name('profile.rs3');

Route::get('os/{rsn}', 'OSProfileController@index')
     ->name('profile.os');
