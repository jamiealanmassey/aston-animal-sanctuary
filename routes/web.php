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

/// TODOS
/// 1) allow deletion of pets/users
/// 2) fix issues with the 'rabbit' types

/// STRETCH TODOS
/// 1) allow admin to upload an array of pictures for a pet (adding/removing)
/// 2) Privacy settings for users

// Default main web routes
Route::get('/', 'MainController@viewLandingPage'); // implemented
Route::get('/adopt', 'MainController@viewAdoptPage'); // implemented/more features

// CRUD Routes for the concept of Pets
Route::get('/pet/new', 'PetController@newPetView'); // implemented
Route::post('/pet/new', 'PetController@newPetCreate'); // implemented
Route::get('/pet/view/{id}', 'PetController@viewPet')->where('id', '[0-9]+'); // implemented
Route::post('/pet/view/request/{id}', 'PetController@viewPetRequest')->where('id', '[0-9]+'); // implemented
Route::post('/pet/view/cancel/{id}', 'PetController@viewPetCancel')->where('id', '[0-9]+'); // implemented
Route::get('/pet/edit/{id}', 'PetController@editPetView')->where('id', '[0-9]+'); // implemented
Route::put('/pet/edit/{id}', 'PetController@editPetUpdate')->where('id', '[0-9]+'); // implemented
Route::delete('/pet/delete/{id}', 'PetController@deletTODOePet')->where('id', '[0-9]+'); // TODO

// CRUD Routes for the concept of Profiles
Route::delete('/profile/delete', 'ProfileController@destroyProfile'); // TODO
Route::put('/profile/edit', 'ProfileController@editProfileUpdate'); // implemented
Route::get('/profile/edit', 'ProfileController@editProfileView'); // implemented
Route::get('/profile/view', 'ProfileController@getProfilePage'); // implemented
Route::get('/profile/view/{id}', 'ProfileController@getProfilePageID')->where('id', '[0-9]+'); // implemented/more features
Route::get('/profile/applications/view', 'ProfileController@applicationsView'); // implemented

Route::get('/applicants/view', 'ApplicantController@viewApplicants'); // implemented
Route::put('/applicants/accept/{id}', 'ApplicantController@acceptApplicant'); // implemented
Route::put('/applicants/reject/{id}', 'ApplicantController@rejectApplicant'); // implemented

// Inject authentication routes
Auth::routes();
