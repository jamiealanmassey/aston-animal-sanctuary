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

    public function viewAdoptPage()
    {
        return view('pages.adopt', array('pets' => Pet::all()));
    }
}
