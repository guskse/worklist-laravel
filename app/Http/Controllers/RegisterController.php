<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;



class RegisterController extends Controller
{

    // @desc show register form
    // @route GET /register
    public function register(): View
    {
        return view('auth.register');
    }


    // @desc store new user to database
    // @route POST /register
    public function store(Request $request): RedirectResponse
    {

        //validate data
        $validatedData = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|string|email|max:100|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        //hash password
        $validatedData['password'] = Hash::make($validatedData['password']);

        //create user and save to DB
        $user = User::create($validatedData);


        //redirect
        return redirect()->route('login')->with('success', 'You are registered and can log in!');
    }
}
