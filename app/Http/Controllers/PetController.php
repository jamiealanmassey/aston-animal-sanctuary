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

    public function petNewPageView()
    {
        return (Auth::user()->admin) ?
            view('pages.pets.new', array('animal_types' => Config::get('animaltypes'), 'animal_breeds' => Config::get('animalbreeds'))) :
            view('pages.landing');
    }

    public function petNewPageCreate(Request $request)
    {
        if (Auth::user()->admin)
        {
            $validator = Validator::make($request->all(), [
                'pet_name' => 'required|string|max:60',
                'pet_type' => 'required|string|max:64',
                'pet_breed' => 'required|string|max:64',
                'pet_age_years' => 'required|integer',
                'pet_age_months' => 'required|integer',
                'pet_description' => 'required|string'
            ]);

            if ($validator->fails()) {
                return redirect('/pet/new')
                    ->withErrors($validator)
                    ->withInput();
            }

            $pet = Pet::create([
                'name' => $request->input('pet_name'),
                'type' => $request->input('pet_type'),
                'breed' => $request->input('pet_breed'),
                'age_years' => $request->input('pet_age_years'),
                'age_months' => $request->input('pet_age_months'),
                'description' => $request->input('pet_description'),
                'availability' => 1,
            ]);

            return ($pet->exists()) ?
                view('pages.pets.view') :
                view('pages.pets.new');
        }

        return view('pages.landing');
    }

    public function petPageView($id)
    {
        return View::make('pages.landing');
    }

    public function editPetPageUpdate($id)
    {
        return View::make('pages.landing');
    }

    public function editPetPageView($id)
    {
        return View::make('pages.landing');
    }

    public function deletePet($id)
    {
        return View::make('pages.landing');
    }
}
