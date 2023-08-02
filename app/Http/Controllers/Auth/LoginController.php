<?php

namespace App\Http\Controllers\Auth;

use App\Models\Agenda;
use App\Models\LogHistory;
use App\Models\TemaPortal;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
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
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm()
    {
        $tema = TemaPortal::get()->first();
        $agendas = Agenda::all();
        return view('auth.login', [
            'title' => 'SSO Portal Polsub',
            'tema' => $tema,
            'agendas' => $agendas,
        ]);
    }

    protected function validateLogin(Request $request)
    {
        $request->validate([
            $this->username() => 'required|string',
            'password' => 'required|string',
            'g-recaptcha-response' => 'required|captcha'
        ]);
    }

    function authenticated(Request $request, $user)
    {
        // $user_agent = $request->header('user-agent');
        // return dd($user_agent);
        LogHistory::create([
            'user_id' => $user->id,
            'ip' => $request->getClientIp(),
            'platform' => trim($request->header('sec-ch-ua-platform'), '"'),
            'user_agent' => $request->header('user-agent'),
            'login_at' => now()
        ]);
    }
}
