<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'login' => 'required|string|max:255|unique:users',
            'isenable'=>'required',
            'telephone'=>'required|string|max:255',
            'profil_id'=>'required|string|max:255',
            'structure_id'=>'required|string|max:255',
        ]);


        $user = User::create([
            'name' => $request->name,
            'prenom' => $request->prenom,
            'login' => $request->login,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'isenable' => $request->isenable,
            'telephone' => $request->telephone,
            'profil_id' => $request->profil_id,
            'structure_id ' => $request->structure_id,


        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
