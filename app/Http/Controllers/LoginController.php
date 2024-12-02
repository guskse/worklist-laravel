<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class LoginController extends Controller
{

    // @desc show login form
    // @route GET /login
    public function login(): View
    {
        return view('auth.login');
    }


    // @desc authenticate user
    // @route POST /login
    public function authenticate(Request $request): RedirectResponse
    {
        //get the request info
        $credentials = $request->validate([
            'email' => 'required|string|email|max:100',
            'password' => 'required|string',
        ]);

        //attemp to authenticate user
        if (Auth::attempt($credentials)) {

            //Regenerate the session to prevent fixation attacks
            $request->session()->regenerate();

            //redirect to home page
            return redirect()->intended(route('home'))->with('success', 'You are now logged in.');
        }

        //if authentication fails, redirect back with error
        return back()->withErrors([
            'email' => 'Invalid credentials'
        ])->onlyInput('email');
    }


    // @desc logout user 
    // @route POST /logout
    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        //invalidate session
        $request->session()->invalidate();

        //regen token
        $request->session()->regenerateToken();

        //redirect to homepage
        return redirect('/');
    }
}
