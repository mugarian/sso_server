<?php

namespace App\Http\Controllers\Auth;

use App\Models\Agenda;
use App\Models\TemaPortal;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    public function showLinkRequestForm()
    {
        $tema = TemaPortal::get()->first();
        $agendas = Agenda::all();
        return view('auth.passwords.email', [
            'tema' => $tema,
            'agendas' => $agendas
        ]);
    }
}
