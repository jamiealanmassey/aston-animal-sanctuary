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
    /*
    |--------------------------------------------------------------------------
    | Applicant Controller
    |--------------------------------------------------------------------------
    |
    | Allows administrators to view the current applicants on the system and make
    | a decision about their application.
    |
    */

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Connected to the /applicants/view route this method will validate admin status,
     * retrieve the requests for the specified pet (all if not specified), and then
     * renders the applicants view.
     *
     * @param Request $request information about the request
     * @return View
     */
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

    /**
     * Connected to the /applicants/accept/{id} route this method will call to the
     * method updateAdoptionStatus to tell the DB to make a decision on the $applicants
     * status
     *
     * @param Request $request information about the request
     * @param int $id ID of the user to modify
     * @return View
     */
    public function acceptApplicant(Request $request, $id)
    {
        $this->updateAdoptionStatus($id, $request->get('pet_id', null), 2, true);
        return redirect()->back();
    }

    /**
     * Connected to the /applicants/reject/{id} route this method will call to the
     * method updateAdoptionStatus to tell the DB to make a decision on the $applicants
     * status
     *
     * @param Request $request information about the request
     * @param int $id ID of the user to modify
     * @return View
     */
    public function rejectApplicant(Request $request, $id)
    {
        $this->updateAdoptionStatus($id, $request->get('pet_id', null), 1);
        return redirect()->back();
    }

    /**
     * Helper method to rejectApplicant and acceptApplicant, this method will update
     * the entry in the adoption relation table for the specified user and pet.
     *
     * @param int $user_id Unique ID of the user to identify in the table
     * @param int $pet_id Unique ID of the pet to identify in the table
     * @param int $status Status to set the relation between the two IDs to (pending, rejected, accepted)/(0/1/2)
     * @param boolean $reject_others Flag that if set will set all others who are pending are the pet to rejected/1
     * @return void
     */
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
                ->update([
                    'adoption_status' => 1,
                    'updated_at' => now()
                ]);
        }

        $pets = User::find($user_id)->pets();
        $pets->detach($pet_id);
        $pets->attach($pet_id, [
            'updated_at' => now(),
            'adoption_status' => $status
        ]);
    }
}
