<?php

namespace App\Http\Controllers;

use DB;
use View;
use Auth;
use Validator;

use App\User;
use App\Pet;
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

    private function getPastAdoptions($id)
    {
        $requested = DB::table('pet_user')
            ->where('user_id', $id)
            ->where('adoption_status', 2)
            ->get();

        $adoptions = [];
        foreach ($requested as $request)
        {
            $adoptions[] = DB::table('pets')->where('id', $request->pet_id)->first();
        }

        return $adoptions;
    }

    /**
     * Locates the currently logged in user if there is one
     *
     * @return View profile page with the current user's details
     */
    public function getProfilePage()
    {
        $adoptions = $this->getPastAdoptions(Auth::user()->id);
        return View::make('pages.profile.view', [ 'user' => Auth::user(), 'adoptions' => $adoptions ]);
    }

    /**
     * Locates the defined user ID in the database and retrieves that user,
     * then renders the pages/profile.blade.php view while passing the found user
     *
     * @return View profile view
     */
    public function getProfilePageID($id)
    {
        $user = DB::table('users')->where('id', $id)->first();
        $adoptions = $this->getPastAdoptions($id);
        return View::make('pages.profile.view', [ 'user' => $user, 'adoptions' => $adoptions ]);
    }

    /**
     * Retrieves the view that shows the user's information with the ability
     * to change everything on their profile
     *
     * @return View edit profile view
     */
    public function editProfileView()
    {
        return View::make('pages.profile.edit', [ 'user' => Auth::user() ]);
    }

    /**
     * Deals with the request to update information about the user's profile
     *
     * @return View view based on outcome (should return to user's profile)
     */
    public function editProfileUpdate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'bio' => 'string|max:1024',
            'birth_date' => 'required|date',
            'location' => 'required|string|min:5|max:128',
        ]);

        if ($validator->fails()) {
            return redirect('/profile/edit')
                ->withErrors($validator)
                ->withInput();
        }

        $user = User::where('id', Auth::user()->id);
        $user->update([
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'bio' => $request->input('biography'),
            'birth_date' => $request->input('birth_date'),
            'location' => $request->input('location'),
        ]);

        return redirect('/profile/view');
    }

    /**
     * Destroys the user's profile.
     *
     * @return View page of the app
     */
    public function destroyProfile()
    {
        // TODO
    }

    public function applicationsView()
    {
        $applications = DB::table('pet_user')->where('user_id', Auth::user()->id)->get();
        return View::make('pages.applications.view', [ 'applications' => $applications ]);
    }

    public function pendingProfileUpdate($id)
    {
        // TODO
    }
}
