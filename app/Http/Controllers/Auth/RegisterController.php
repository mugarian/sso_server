<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\Agenda;
use App\Models\TemaPortal;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showRegistrationForm()
    {
        $tema = TemaPortal::get()->first();
        $agendas = Agenda::all();
        return view('auth.register', [
            'title' => 'SSO Portal Polsub',
            'tema' => $tema,
            'agendas' => $agendas,
        ]);
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
            'role' => ['required'],
            'major' => ['required'],
            'no_induk' => ['required', 'unique:users'],
            'no_hp' => ['required', 'unique:users'],
            'birthdate' => ['required'],
            'address' => ['required'],
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:20', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'avatar' => 'nullable|image|mimes:jpg,jpeg,png|max:8000',
            'attachment' => 'nullable|image|mimes:jpg,jpeg,png|max:8000',
            'g-recaptcha-response' => 'required|captcha'
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        if ($data['avatar'] ?? null) {
            $data['avatar'] = $data['avatar']->store('user-images');
        }

        if ($data['attachment'] ?? null) {
            $data['attachment'] = $data['attachment']->store('user-attachment');
        }

        return $user = User::create([
            'avatar' => $data['avatar'] ?? null,
            'attachment' => $data['attachment'] ?? null,
            'role' => $data['role'],
            'major' => $data['major'],
            'no_induk' => $data['no_induk'],
            'no_hp' => '62' . $data['no_hp'],
            'birthdate' => $data['birthdate'],
            'address' => $data['address'],
            'name' => $data['name'],
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'status' => 1,
            'isVerified' => 0,
            'isRegistered' => 1,
            'isMicrosoftAccount' => 0,
        ]);

        event(new Registered($user));
    }
}
