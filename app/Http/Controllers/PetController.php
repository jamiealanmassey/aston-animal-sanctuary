<?php

namespace App\Http\Controllers;

use View;
use Auth;
use Config;
use Validator;

use App\Pet;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PetController extends Controller
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

    public function newPetView()
    {
        return (Auth::user()->admin) ?
            view('pages.pets.new', array('animal_types' => Config::get('animaltypes'), 'animal_breeds' => Config::get('animalbreeds'))) :
            view('pages.landing');
    }

    public function newPetCreate(Request $request)
    {
        if (Auth::user()->admin)
        {
            $validator = Validator::make($request->all(), [
                'pet_name' => 'required|string|max:60',
                'pet_type' => 'required|string|max:64',
                'pet_breed' => 'required|string|max:64',
                'pet_age_years' => 'required|integer',
                'pet_age_months' => 'required|integer',
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
                view('pages.pets.view', [ 'pet' => $pet ]) :
                view('pages.pets.new');
        }

        return view('pages.landing');
    }

    public function viewPetRequest($id) {

    }

    public function viewPet($id)
    {
        $pet = Pet::where('id', $id)->first();
        return View::make('pages.pets.view', [ 'pet' => $pet ]);
    }

    public function editPetView($id)
    {
        return View::make('pages.landing');
    }

    public function editPetUpdate($id)
    {
        return View::make('pages.landing');
    }

    public function deletePet($id)
    {
        return View::make('pages.landing');
    }
}
