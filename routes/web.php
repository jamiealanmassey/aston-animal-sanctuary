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

// CRUD Routes for the concept of Pets
Route::post('/pet/new', 'PetController@petPageCreate');
Route::get('/pet/{id}', 'PetController@petPageView');
Route::get('/pet/edit/{id}', 'PetController@editPetPageView');
Route::put('/pet/edit/{id}', 'PetController@editPetPageUpdate');
Route::delete('/pet/delete/{id}', 'PetController@deletePet');

// CRUD Routes for the concept of Profiles
Route::get('/profile', 'ProfileController@getProfilePage');
Route::get('/profile/{id}', 'ProfileController@getProfilePageID');
Route::get('/profile/edit', 'ProfileController@editProfileView');
Route::put('/profile/edit', 'ProfileController@editProfileUpdate');
Route::delete('/profile/delete', 'ProfileController@destroyProfile');

// Inject authentication routes
Auth::routes();
