<?php

namespace App\Http\Controllers;

use Auth;
use DB;
use View;

use Illuminate\Http\Request;

class ApplicantController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function viewApplicants(Request $request)
    {
        if (!Auth::user()->admin)
            return redirect()->back();

        $pet_id = $request->get('pet_id', null);
        $requests = ($pet_id !== null) ?
            DB::table('pet_user')->where(array(
                'pet_id' => $pet_id,
                'adoption_status' => 0))->get() :
            DB::table('pet_user')->where('adoption_status', 0)->get();

        return View::make('pages.admin.applicants', [ 'requests' => $requests ]);
    }

    public function acceptApplicant($id)
    {
        if (!Auth::user()->admin)
            return redirect()->back();
    }

    public function rejectApplicant($id)
    {
        if (!Auth::user()->admin)
            return redirect()->back();


    }
}
