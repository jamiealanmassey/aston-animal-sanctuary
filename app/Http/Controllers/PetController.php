<?php

namespace App\Http\Controllers;

use View;
use Auth;
use Config;
use Validator;
use DB;

use App\User;
use App\Pet;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PetController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Pet Controller
    |--------------------------------------------------------------------------
    |
    | Deals in the viewing, creation, editing and deletion of pets from the DB.
    |
    */

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
     * Connected to the /pet/new route this method will render the form for creating
     * a new pet if the user has admin status, otherwise the user will be returned to
     * the landing page.
     *
     * @return View
     */
    public function newPetView()
    {
        return (Auth::user()->admin) ?
            view('pages.pets.new', array('animal_types' => Config::get('animaltypes'), 'animal_breeds' => Config::get('animalbreeds'))) :
            view('pages.landing');
    }

    /**
     * Connected to the /pet/new route this method will make a post request from the user
     * and attempt to add the new pet to the database
     *
     * @param Request $request information about the request
     * @return View
     */
    public function newPetCreate(Request $request)
    {
        if (Auth::user()->admin)
        {
            $validator = Validator::make($request->all(), [
                'pet_name' => 'required|string|max:60',
                'pet_type' => 'required|integer',
                'pet_breed' => 'required|integer',
                'pet_age_years' => 'required|integer',
                'pet_age_months' => 'required|integer|min:0|max:11',
                'pet_description' => 'required|string',
                'profile_image' => [ 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048' ],
            ]);

            if ($validator->fails())
            {
                return redirect('/pet/new')
                    ->withErrors($validator)
                    ->withInput();
            }

            $pet = Pet::create([
                'name' => $request->pet_name,
                'type' => $request->pet_type,
                'breed' => $request->pet_breed,
                'age_years' => $request->pet_age_years,
                'age_months' => $request->pet_age_months,
                'description' => $request->pet_description,
                'profile_img' => 'img/0_200.png',
                'availability' => 1,
            ]);

            if ($pet->exists())
            {
                if ($request->hasFile('profile_image') && $request->file('profile_image')->isValid())
                {
                    $img = $request->file('profile_image');
                    $img_name = time() . '_' . 'profile.' . $img->getClientOriginalExtension();
                    $img_loc = 'img/profiles/' . $request->type . '/' . $pet->id . '/';
                    $img->move($img_loc, $img_name);

                    // Update the Pet record
                    $pet->profile_img = $img_loc . $img_name;
                    $pet->save();
                }
            }

            return ($pet->exists()) ?
                View::make('pages.pets.view', [ 'pet' => $pet ]) :
                View::make('pages.pets.new');
        }

        return redirect('/');
    }

    /**
     * Helper method that determines if the Pet has already been adopted by another
     * user or not.
     *
     * @param int $id ID of the pet to be checked
     * @return boolean
     */
    public function isAlreadyAdopted($id)
    {
        $already_adopted = DB::table('pet_user')
            ->where('pet_id', '=', $id)
            ->where('adoption_status', '=', 2)
            ->get();

        return count($already_adopted) > 0;
    }

    /**
     * Connected to the /pet/view/request/{id} route this method will make a post request from the user
     * and attempt to make an adoption request
     *
     * @param int $id ID of the pet the user wants to adopt
     * @return View
     */
    public function viewPetRequest($id)
    {
        if ($this->isAlreadyAdopted($id))
            return redirect()->back();

        Auth::user()->pets()->syncWithoutDetaching([$id =>
            [
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);

        return redirect()->back();
    }

    /**
     * Connected to the /pet/view/cancel/{id} route this method will make a post request from the user
     * and attempt to cancel an adoption request
     *
     * @param int $id ID of the pet the user wants to adopt
     * @return View
     */
    public function viewPetCancel($id)
    {
        if ($this->isAlreadyAdopted($id))
            return redirect('/adopt');

        Auth::user()->pets()->detach($id);
        return redirect()->back();
    }

    /**
     * Connected to the /pet/view/{id} route this method will render the page for
     * the pet with the specified ID
     *
     * @param int $id ID of the pet the user wants to adopt
     * @return View
     */
    public function viewPet($id)
    {
        $pet = Pet::where('id', $id)->first();
        $pet->impressions = $pet->impressions + 1;
        $pet->save();
        $applicants = array();
        $filter = DB::table('pet_user')->where('pet_id', $id)->get();
        foreach ($filter as $element) {
            $applicants[] = User::find($element->user_id);
        }

        return View::make('pages.pets.view', [ 'pet' => $pet, 'applicants' =>  $applicants]);
    }

    /**
     * Connected to the /pet/edit/{id} route this method will render the page for
     * the form to edit the pet with the specified ID
     *
     * @param int $id ID of the pet the user wants to adopt
     * @return View
     */
    public function editPetView($id)
    {
        if (Auth::user()->admin)
        {
            $pet = Pet::where('id', $id)->first();
            return View::make('pages.pets.edit', [
                'pet' => $pet
            ]);
        }

        return (!Auth::user()->admin) ?
            redirect('/') :
            redirect('/login');
    }

    /**
     * Connected to the /pet/edit/{id} route this POST method will validate the form
     * input and updates information about the pet
     *
     * @param Request $request information about the request
     * @return View
     */
    public function editPetUpdate(Request $request)
    {
        if (!Auth::user()->admin) return redirect('/');

        $validator = Validator::make($request->all(), [
            'pet_name' => 'required|string|max:60',
            'pet_type' => 'required|string|max:64',
            'pet_breed' => 'required|string|max:64',
            'pet_age_years' => 'required|integer',
            'pet_age_months' => 'required|integer|min:0|max:11',
            'pet_description' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect('pet/edit/' . $request->id)
                ->withErrors($validator)
                ->withInput();
        }

        $pet = Pet::where('id', $request->id);
        $pet->update([
            'type' => $request->input('pet_type'),
            'breed' => $request->input('pet_breed'),
            'age_years' => $request->input('pet_age_years'),
            'age_months' => $request->input('pet_age_months'),
            'description' => $request->input('pet_description'),
            'name' => $request->input('pet_name'),
        ]);

        return redirect('/pet/view/' . $request->id);
    }

    /**
     * Connected to the /pet/delete/{id} route this DELETE method will attempt to
     * remove the pet with the specified ID from the server and cascades its destruction
     *
     * @param Request $request information about the request
     * @return View
     */
    public function deletePet($id)
    {
        $pet = Pet::find($id);
        $pet->delete();
        return redirect('/');
    }
}
