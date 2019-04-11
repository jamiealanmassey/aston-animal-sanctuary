<?php

namespace App\Http\Controllers;

use Auth;
use DB;
use View;

use App\User;
use App\Pet;
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

    public function acceptApplicant(Request $request, $id)
    {
        $this->updateAdoptionStatus($id, $request->get('pet_id', null), 2, true);
        return redirect()->back();
    }

    public function rejectApplicant(Request $request, $id)
    {
        $this->updateAdoptionStatus($id, $request->get('pet_id', null), 1);
        return redirect()->back();
    }

    private function updateAdoptionStatus($user_id, $pet_id, $status, $reject_others = false)
    {
        if (!Auth::user()->admin || $user_id == null || $pet_id == null)
        {
            $error_msg = 'Could not update adoption status for user ';
            $error_msg = $error_msg . $user_id . ' against pet ' . $pet_id . '.\n';
            $error_msg = $error_msg . 'Admin status: ' . Auth::user()->admin;
            Log::error($error_msg);
            return;
        }

        if ($reject_others)
        {
            DB::table('pet_user')
                ->where('adoption_status', '=', 0)
                ->where('user_id', '!=', $user_id)
                ->where('pet_id', '=', $pet_id)
                ->update([ 'adoption_status' => 1 ]);
        }

        $pets = User::find($user_id)->pets();
        $pets->detach($pet_id);
        $pets->attach($pet_id, [ 'adoption_status' => $status ]);
    }
}
