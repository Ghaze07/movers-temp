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

Auth::routes();
Route::get('/', 'SiteController@index');
Route::get('/blog', 'BlogController@index')->name('blogs');
Route::get('/blog/{blog}', 'BlogController@show')->name('blog');

Route::group(['middleware' => 'auth'], function() {
    Route::get('/dashboard', 'SiteController@dashboard')->name('home');
});
