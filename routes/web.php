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

Route::get('/home', 'AlertController@index')->name('home');
Route::get('/', 'AlertController@index')->name('home');

Route::get('/alerts/create', 'AlertController@create')->name('create-alert');
Route::get('/alerts', 'AlertController@index')->name('alerts');
Route::get('/alerts/show', 'AlertController@show')->name('show');
Route::post('/alerts', 'AlertController@store')->name('store-alert');
Route::get('/alerts/delete/{alertId}', 'AlertController@delete')->name('delete-alert');
Route::get('/alerts/results/{alertId}', 'AlertController@results')->name('alert-results');


Route::get('/scraper/refresh', function() {
    $scraper = new Scraper();
    $posts = Post::deleteAll();
    $scraper->storeNewPosts();
    echo 'Completed';
});
Route::get('/scraper/update', function() {
    $scraper = new Scraper();
    $scraper->storeNewPosts();
    echo 'Completed';
});
Auth::routes();

Route::get('/mailtest', function() {
    $user = Auth::user();
    \Mail::to($user)->send(new PostFound);

    return view('emails.post-found');
});

