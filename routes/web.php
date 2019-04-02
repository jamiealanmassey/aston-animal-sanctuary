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
    return View::make('pages.landing');
});

Route::get('/adopt', function () {
    return View::make('pages.adopt');
});

Route::get('/pending', function () {
    return View::make('pages.pending');
});

Route::get('/profile', function () {
    return View::make('pages.profile');
});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
