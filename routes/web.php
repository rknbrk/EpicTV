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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::group(['middleware' => ['auth', 'admin']], function() {

    Route::get('/streams/new', 'StreamController@create');

    Route::get('/streams/{stream_slug}/edit', 'StreamController@edit');

    Route::post('/streams', 'StreamController@store')->name('store_stream');

    Route::patch('/streams/{slug}', 'StreamController@update');

    Route::post('/streams/comment/{slug}', 'CommentController@store');



});



Route::get('/home', 'HomeController@index')->name('home');


Route::get('/streams', 'StreamController@index');


Route::get('/streams/{stream_slug}', 'StreamController@show');






