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

Route::get('/', 'MainController@viewLandingPage');

/*Route::get('/pending', function () {
    return View::make('pages.pending');
});*/

Route::get('/adopt', 'MainController@viewAdoptPage');

// CRUD Routes for the concept of Pets
Route::get('/pet/new', 'PetController@petNewPageView');
Route::post('/pet/new', 'PetController@petNewPageCreate');
Route::get('/pet/{id}', 'PetController@petPageView')->where('id', '[0-9]+');
Route::get('/pet/edit/{id}', 'PetController@editPetPageView')->where('id', '[0-9]+');
Route::put('/pet/edit/{id}', 'PetController@editPetPageUpdate')->where('id', '[0-9]+');
Route::delete('/pet/delete/{id}', 'PetController@deletePet')->where('id', '[0-9]+');

// CRUD Routes for the concept of Profiles
Route::delete('profile/delete', 'ProfileController@destroyProfile');
Route::put('profile/edit', 'ProfileController@editProfileUpdate');
Route::get('profile/edit', 'ProfileController@editProfileView');
Route::get('profile', 'ProfileController@getProfilePage');
Route::get('profile/{id}', 'ProfileController@getProfilePageID')->where('id', '[0-9]+');

// Inject authentication routes
Auth::routes();
