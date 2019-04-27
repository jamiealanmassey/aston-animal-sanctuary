<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

use Auth;
use Log;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:191', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'max:20', 'confirmed'],
            'bio' => ['string', 'max:512'],
            'profile_image' => ['image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
            'birth_date' => ['required', 'date'],
            'location' => ['required', 'string', 'min:5', 'max:128']
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $request = request();
        if ($request->hasFile('profile_image') && $request->file('profile_image')->isValid())
        {
            $image = $request->file('profile_image');
            $filename = time() . '_' . strtolower($data['first_name']) . '.' . $image->getClientOriginalExtension();
            $location = 'img/profiles/';
            $image->move($location, $filename);
        }

        return User::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'birth_date' => $data['birth_date'],
            'location' => $data['location'],
            'bio' => $data['biography'],
            'admin' => 0,
            'profile_image' => isset($location) ? $location . $filename : null
        ]);
    }
}
