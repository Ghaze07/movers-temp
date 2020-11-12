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
// Blog
Route::get('/blog', 'BlogController@index')->name('blogs');
Route::get('/blog/{blog}', 'BlogController@show')->name('blog');

//Auth::routes();
Route::post('login', 'Auth\LoginController@login')->name('login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');
Route::post('register', 'Auth\RegisterController@register')->name('register');
//Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');

Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::get('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');

Route::post('cartItem','CartItemController@store')->name('cartItem.store');
Route::get('setCities/{region}', 'RegionController@setCities')->name('setCities');
Route::post('address', 'AddressController@store')->name('address.store');
Route::get('setSavedAddresses', 'AddressController@setSavedAddresses')->name('setSavedAddresses');
Route::post('processingOptions', 'OrderController@processingOptions')->name('processingOptions');
Route::get('setReceiver', 'OrderController@setReceiver')->name('setReceiver');
Route::post('placeOrder', 'OrderController@placeOrder')->name('placeOrder');
// Route::get('', '@')->name('');

// Authenticated Users
Route::group(['middleware' => 'auth'], function() {
    Route::get('register/resendOtp', 'UserController@resendOtp');
    Route::post('register/verify', 'UserController@verifyMobile');

    Route::group(['middleware' => 'admin'], function() {
        Route::get('/dashboard', 'SiteController@dashboard')->name('home');
        Route::get('/farms', 'FarmController@index')->name('farms');
        Route::get('/farm/{id}', 'FarmController@show')->name('farm');
        Route::get('/farm/products/{farm}', 'FarmController@products')->name('farm.products');
        Route::get('/authors', 'AuthorController@index')->name('authors');
        Route::get('/blogs', 'BlogController@list')->name('blogs.list');
        Route::get('/users', 'UserController@index')->name('users');
        Route::resource('/countries', 'CountryController');
        Route::resource('/regions', 'RegionController');
        Route::resource('/cities', 'CityController');
        Route::get('/measuring_units', 'MeasuringUnitController@index')->name('measuringUnits');
        Route::get('/products', 'ProductsController@index')->name('products');
        Route::get('/product/categories', 'ProductCategoriesController@index')->name('product.categories');
        Route::get('/product/sources', 'ProductSourcesController@index')->name('product.sources');
    });
});
