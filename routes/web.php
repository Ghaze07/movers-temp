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

Route::get('/', 'SiteController@index')->name('welcome');

Route::get('/all_services', 'ServiceController@allServices')->name('get_all_services');

Route::get('get_all_cities', 'CityController@getAllCities')->name('get_all_cities');

Route::post('/contact', 'ContactFormController@submit')->name('contact');
//Auth::routes();
Route::post('login', 'Auth\LoginController@login')->name('login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');
Route::post('register', 'Auth\RegisterController@register')->name('register');


Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::post('password/mobile', 'Auth\ResetPasswordController@sendResetLinkSms')->name('password.sms');
Route::get('password/reset{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');


// Authenticated Users
Route::group(['middleware' => 'auth'], function() {
    Route::get('register/resendOtp', 'UserController@resendOtp');
    Route::post('register/verify', 'UserController@verifyMobile');
    Route::get('/settings', 'SiteController@settings')->name('settings');

    Route::get('/change-password', 'PasswordController@index')->name('change-password');
    Route::post('change-password', 'PasswordController@store')->name('change.password');
    
    Route::get('/change-mobile', 'UserController@mobile')->name('change-mobile');
    Route::post('change-mobile', 'UserController@mobileUpdate')->name('change.mobile');

    Route::get('/change-email', 'UserController@email')->name('change-email');
    Route::post('change-email', 'UserController@updateEmail')->name('change.email');

    // Route for storing booking form
    Route::post('/booking', 'BookingController@store')->name('booking.store');


    // admin
    Route::group(['middleware' => 'admin'], function() {
        Route::get('/dashboard', 'SiteController@dashboard')->name('home');
        Route::get('/users', 'UserController@index')->name('users');
        Route::resource('user', 'UserController');
        Route::resource('/countries', 'CountryController');
        Route::get('get_countries', 'CountryController@getCountries')->name('get_countries');
        Route::resource('/regions', 'RegionController');
        Route::get('get_regions', 'RegionController@getRegions')->name('get_regions');
        Route::get('get_active_countries', 'RegionController@getActiveCountries')->name('countries.active');
        Route::get('get_active_regions', 'AddressController@getActiveRegions')->name('regions.active');
        
        Route::resource('/cities', 'CityController');
        

        Route::resource('/services', 'ServiceController');
        Route::post('/update_service', 'ServiceController@updateService')->name('update_service');

        Route::get('/bookings', 'BookingController@index')->name('bookings.index');
        Route::get('/all_bookings', 'BookingController@getAllBookings')->name('all_bookings');
        Route::put('/bookings/{booking}', 'BookingController@update')->name('bookings.update');
    });
});
