<?php

namespace App\Listeners;

use App\Models\User;
use Dcblogdev\MsGraph\MsGraph;
use Illuminate\Support\Facades\Auth;

class NewMicrosoft365SignInListener
{
    public function handle($event)
    {
        $emailArray = explode('@', $event->token['info']['mail']);

        $user = User::where('email', $event->token['info']['mail'])->first();

        if (!$user) {
            $user = User::create([
                'name'     => $event->token['info']['displayName'],
                'email'    => $event->token['info']['mail'] ?? $event->token['info']['userPrincipalName'],
                'birthdate' => '2000-01-01',
                'no_induk' => rand(),
                'no_hp' => $event->token['info']['mobilePhone'],
                'address' => 'subang',
                'major' => 'tamu',
                'role' => 'tamu',
                'status' => 1,
                'isRegistered' => 0,
                'isVerified' => 1,
                'isMicrosoftAccount' => 1,
                'username' => $emailArray[0],
                'password' => $emailArray[0],
                'email_verified_at' => now()
            ]);
        }

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
