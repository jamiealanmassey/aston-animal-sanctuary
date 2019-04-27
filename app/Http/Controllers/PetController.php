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

    public function isAlreadyAdopted($id)
    {
        $already_adopted = DB::table('pet_user')
            ->where('pet_id', '=', $id)
            ->where('adoption_status', '=', 2)
            ->get();

        return count($already_adopted) > 0;
    }

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

    public function viewPetCancel($id)
    {
        if ($this->isAlreadyAdopted($id))
            return redirect('/adopt');

        Auth::user()->pets()->detach($id);
        return redirect()->back();
    }

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

    public function deletePet($id)
    {
        return View::make('pages.landing');
    }
}
