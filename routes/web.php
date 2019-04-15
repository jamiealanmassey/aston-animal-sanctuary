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

/// OTHER TODOS
/// 1) update stored pet types and breeds (limit to dogs/cats/rabbits for now)
/// 2) cron job to calculate featured pets every night at midnight or every 6 hours
/// 3) allow user to change their own profile picture
/// 4) allow admin to change profile picture of pet
/// 5) update request fragment for admins to display "Adopted" in green when pet is adopted
/// 6) show list of all pets that user has adopted on profile page
/// 7) update pet page when adopted so that pending adoptions do not show anymore
/// 8) allow deletion of pets/users

/// STRETCH TODOS
/// 1) allow admin to upload an array of pictures for a pet (adding/removing)
/// 2) filtering of results on Adoption page
/// 3) Privacy settings for users

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
