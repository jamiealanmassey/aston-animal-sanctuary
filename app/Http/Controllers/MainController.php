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

    public function viewAdoptPage(Request $request)
    {
        $filter_sort = $request->input('filters-sort');
        $filter_type = $request->input('filters-type');

        switch($filter_sort)
        {
            case 0:
                $pets = DB::table('pets')->where('type', $filter_type)->orderBy('impressions');
                break;
            case 1:
                $pets = DB::table('pets')->where('type', $filter_type)->orderBy('name');
                break;
            case 2:
                $pets = DB::table('pets')->where('type', $filter_type)->orderBy('name', 'DESC');
                break;
            case 3:
                $pets = DB::table('pets')->where('type', $filter_type)->orderBy('created_at');
                break;
            case 4:
                $pets = DB::table('pets')->where('type', $filter_type)->orderBy('created_at', 'DESC');
                break;
            default:
                $pets = DB::table('pets')->orderBy('impressions');
                break;
        }

        $pets = $pets->paginate(3);
        $pets->appends([ 'filters-sort' => $filter_sort, 'filters-type' => $filter_type ]);
        return View::make('pages.adopt', [
            'pets' => $pets,
            'filter_sort' => $filter_sort,
            'filter_type' => $filter_type,
        ]);
    }
}
