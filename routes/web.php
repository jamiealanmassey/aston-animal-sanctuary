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

// Default main web routes
Route::get('/', 'MainController@viewLandingPage');
Route::get('/adopt', 'MainController@viewAdoptPage');

// CRUD Routes for the concept of Pets
Route::get('/pet/new', 'PetController@newPetView');
Route::post('/pet/new', 'PetController@newPetCreate');
Route::get('/pet/view/{id}', 'PetController@viewPet')->where('id', '[0-9]+');
Route::post('/pet/view/request/{id}', 'PetController@viewPetRequest')->where('id', '[0-9]+');
Route::get('/pet/edit/{id}', 'PetController@editPetView')->where('id', '[0-9]+');
Route::put('/pet/edit/{id}', 'PetController@editPetUpdate')->where('id', '[0-9]+');
Route::delete('/pet/delete/{id}', 'PetController@deletePet')->where('id', '[0-9]+');

// CRUD Routes for the concept of Profiles
Route::delete('/profile/delete', 'ProfileController@destroyProfile');
Route::put('/profile/edit', 'ProfileController@editProfileUpdate');
Route::get('/profile/edit', 'ProfileController@editProfileView');
Route::get('/profile/view', 'ProfileController@getProfilePage');
Route::get('/profile/view/{id}', 'ProfileController@getProfilePageID')->where('id', '[0-9]+');
Route::get('/profile/pending/view', 'ProfileController@pendingProfileView');

// Inject authentication routes
Auth::routes();
