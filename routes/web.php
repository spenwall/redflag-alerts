<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\AlertControllere;
use App\Scraper;
use App\Post;
use App\Http\Controllers\AlertController;
use App\Mail\PostFound;

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

Route::get('/', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@index')->name('home');

Route::get('/alerts', 'AlertController@alerts')->name('alerts');
Route::post('/alerts/store', 'AlertController@store')->name('store-alert');
Route::get('/alerts/delete/{alertId}', 'AlertController@delete')->name('delete-alert');
Route::get('/alerts/posts/{alertId}', 'AlertController@posts')->name('alert-posts');

Auth::routes();