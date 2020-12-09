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
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::post('password/mobile', 'Auth\ResetPasswordController@sendResetLinkSms')->name('password.sms');
Route::get('password/reset{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');

Route::post('cartItem','CartItemController@store')->name('cartItem.store');
Route::put('cartItem','CartItemController@update')->name('cartItem.update');
Route::delete('cartItem/{cartItem}','CartItemController@destroy')->name('cartItem.destroy');

Route::get('setCities/{region}', 'RegionController@setCities')->name('setCities');
Route::get('setSavedAddresses', 'AddressController@setSavedAddresses')->name('setSavedAddresses');
Route::get('setDeliveryCharges/{address_id}', 'AddressController@setDeliveryCharges')->name('setDeliveryCharges');
Route::resource('order', 'OrderController');
Route::post('processingOptions', 'OrderController@processingOptions')->name('processingOptions');
Route::get('setReceiver', 'OrderController@setReceiver')->name('setReceiver');
Route::post('placeOrder', 'OrderController@placeOrder')->name('placeOrder');
Route::post('trackOrder', 'OrderController@trackOrder')->name('trackOrder');
Route::get('getCities/{region_id}', 'OrderController@getCities')->name('getCities');
Route::post('createUser', 'OrderController@createUser')->name('createUser');
Route::post('createAddress', 'OrderController@createAddress')->name('createAddress');
Route::post('createAddressUser', 'OrderController@createAddressUser')->name('createAddressUser');
Route::get('getAddresses/{user_id}', 'OrderController@getAddresses')->name('getAddresses');
Route::get('getFarmProducts/{farm_id}', 'OrderController@getFarmProducts')->name('getFarmProducts');
Route::get('getCartItems/{user_id}', 'OrderController@getCartItems')->name('getCartItems');
Route::post('addToCart', 'OrderController@addToCart')->name('addToCart');
Route::delete('removeFromCart/{id}', 'OrderController@removeFromCart')->name('removeFromCart');
Route::post('adminCreateOrder', 'OrderController@adminCreateOrder')->name('adminCreateOrder');
Route::put('adminUpdateOrder/{order_id}', 'OrderController@adminUpdateOrder')->name('adminUpdateOrder');
Route::get('orderItems/{order_id}', 'OrderController@orderItems')->name('orderItems');
Route::get('myorders', 'OrderTrackingController@index')->name('myorders.index');
Route::get('/orderStatus/{id}','OrderTrackingController@orderStatus')->name('orderStatus');
// Route::get('', '@')->name('');
// Authenticated Users
Route::group(['middleware' => 'auth'], function() {
    Route::get('register/resendOtp', 'UserController@resendOtp');
    Route::post('register/verify', 'UserController@verifyMobile');
    Route::get('/settings', 'SiteController@settings')->name('settings');
    
    Route::get('address', 'AddressController@index')->name('address.index');
    Route::put('address/{id}', 'AddressController@update')->name('address.update');
    Route::delete('address/{id}', 'AddressController@destroy')->name('address.destroy');
    Route::get('get_regions', 'AddressController@getRegions')->name('get_regions');
    Route::get('get_cities', 'AddressController@getCities')->name('get_cities');
    Route::get('get_addresses', 'AddressController@getAddresses')->name('get_addresses');

    Route::get('/change-password', 'PasswordController@index')->name('change-password');
    Route::post('change-password', 'PasswordController@store')->name('change.password');
    
    Route::get('/change-mobile', 'UserController@mobile')->name('change-mobile');
    Route::post('change-mobile', 'UserController@update')->name('change.mobile');

    Route::group(['middleware' => 'admin'], function() {
        Route::get('/dashboard', 'SiteController@dashboard')->name('home');
        Route::get('/farms', 'FarmController@index')->name('farms');
        Route::resource('/farmsproduct', 'FarmProductController');
        Route::get('/farm/{id}', 'FarmController@show')->name('farm');
        Route::get('/farm/products/{farm}', 'FarmController@products')->name('farm.products');
        Route::get('/authors', 'AuthorController@index')->name('authors');
        Route::get('/blogs', 'BlogController@list')->name('blogs.list');
        Route::get('/users', 'UserController@index')->name('users');
        Route::resource('/countries', 'CountryController');
        Route::resource('/regions', 'RegionController');
        Route::resource('/cities', 'CityController');
        Route::get('/measuring_units', 'MeasuringUnitController@index')->name('measuringUnits');

        Route::resource('/products', 'ProductsController');
        Route::get('/products', 'ProductsController@index')->name('products');

        Route::resource('/product/categories', 'ProductCategoriesController');
        Route::get('/product/categories', 'ProductCategoriesController@index')->name('product.categories');

        Route::resource('/product/sources', 'ProductSourcesController');
        Route::get('/product/sources', 'ProductSourcesController@index')->name('product.sources');
    });
});
