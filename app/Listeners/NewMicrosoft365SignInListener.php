<?php

namespace App\Listeners;

use App\Models\User;
use Dcblogdev\MsGraph\MsGraph;
use Illuminate\Support\Facades\Auth;

class NewMicrosoft365SignInListener
{
    public function handle($event)
    {
        $username = explode('@', $event->token['info']['mail']);
        $password = explode('.', $username[0]);
        $user  = User::firstOrCreate([
            'email' => $event->token['info']['mail'],
        ], [
            'name'     => $event->token['info']['displayName'],
            'email'    => $event->token['info']['mail'] ?? $event->token['info']['userPrincipalName'],
            'birthdate' => '2000-01-01',
            'no_induk' => rand(),
            'no_hp' => $event->token['info']['mobilePhone'],
            'address' => 'subang',
            'major' => 'mi',
            'role' => 'guest',
            'status' => 1,
            'isMicrosoftAccount' => 1,
            'username' => $username[0],
            'password' => '',
        ]);

        (new MsGraph())->storeToken(
            $event->token['accessToken'],
            $event->token['refreshToken'],
            $event->token['expires'],
            $user->id,
            $user->email
        );

        Auth::login($user);
    }
}
