<?php

namespace App\Http\Controllers;

use View;
use DB;

use App\Pet;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function __construct()
    {
    }

    public function viewLandingPage()
    {
        $featured_pets_db = DB::table('featured_relation')->get();
        $featured_pets = [];
        foreach ($featured_pets_db as $entry) {
            $featured_pets[] = Pet::find($entry->pet_id);
        }

        return View::make('pages.landing', [ 'featured_pets' => $featured_pets ]);
    }

    public function viewAdoptPage()
    {
        return view('pages.adopt', array('pets' => Pet::all()));
    }
}
