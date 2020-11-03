<?php

namespace App\Http\Controllers;

use App\Http\Requests\Login;
use App\Http\Requests\Register;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register()
    {
        return view('auth/register');
    }


    public function signUp(Register $request, User $user)
    {
        Auth::login($user->add($request->validated()));

        return redirect()->route('home');
    }


    public function login()
    {
        return view('auth/login');
    }


    public function signIn(Login $request)
    {
        if (Auth::attempt($request->only('email', 'password'), $request->has('remember'))) {
            return redirect()->intended(route('home'));
        }

        return redirect()->back()->with('danger', 'Authentication failed!');
    }


    public function logout()
    {
        Auth::logout();

        return redirect()->route('login');
    }
}
