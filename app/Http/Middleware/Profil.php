<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Profil
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->user()->isRegistered) {
            return $next($request);
        } else {
            return redirect('/profile')->with('fail', 'Lengkapi Kolom Profil untuk menyelesaikan pendafataran akun sistem SSO');
        }
    }
}
