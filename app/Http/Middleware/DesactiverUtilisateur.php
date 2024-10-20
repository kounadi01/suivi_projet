<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DesactiverUtilisateur
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */

    public function handle(Request $request, Closure $next)
    {

        /*DB::table('users')
            ->where('users.id', Auth::id())
            ->where('isenable', true)*/
        if(Auth::check() && (auth()->user()->isenable == 0)){

            Auth::logout();

            $request->session()->invalidate();

            $request->session()->regenerateToken();

            return redirect()->route('login')->with('error', 'Votre compte a été suspendu, veuillez contacter l\'administrateur pour en savoir plus.');

        }

        return $next($request);
    }
}
