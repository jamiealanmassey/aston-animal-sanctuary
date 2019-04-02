<?php

namespace App\Http\Controllers;

use View;
use Auth;
use Config;

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
            view('pages.admin.new', array('animal_types' => Config::get('animaltypes'), 'animal_breeds' => Config::get('animalbreeds'))) :
            view('pages.landing');
    }

    public function petNewPageCreate()
    {
        if (Auth::user()->admin)
        {

        }

        return View::make('pages.landing');
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
