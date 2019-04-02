<?php

namespace App\Http\Controllers;

use DB;
use View;
use Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /**
     * Constructor called when accessing a profile, ensures that a
     * User must be logged in before anything else happens
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Locates the currently logged in user if there is one
     *
     * @return View profile page with the current user's details
     */
    public function getProfilePage()
    {
        return View::make('pages.profile', [ 'user' => Auth::user() ]);
    }

    /**
     * Locates the defined user ID in the database and retrieves that user,
     * then renders the pages/profile.blade.php view while passing the found user
     *
     * @return View profile view
     */
    public function getProfilePageID($id)
    {
        // TODO: Block giving results on profiles set to private
        $user = DB::table('users')->where('id', $id)->first();
        return View::make('pages.profile', [ 'user' => $user ]);
    }

    /**
     * Retrieves the view that shows the user's information with the ability
     * to change everything on their profile
     *
     * @return View edit profile view
     */
    public function editProfileView()
    {

    }

    /**
     * Deals with the request to update information about the user's profile
     *
     * @return View view based on outcome (should return to user's profile)
     */
    public function editProfileUpdate()
    {

    }

    /**
     * Destroys the user's profile.
     *
     * @return View page of the app
     */
    public function destroyProfile()
    {

    }
}
