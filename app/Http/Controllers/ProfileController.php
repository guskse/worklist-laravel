<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    //@desc Update profile info
    //@route PUT /profile

    public function update(Request $request): RedirectResponse
    {
        //get logged in user
        $user = Auth::user();

        //validate data
        $validatedData = $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|email',
            'avatar' => 'nullable|image|mimes:jpeg,jpg,png|max:2048'
        ]);

        //Get user name and email
        $user->name = $request->input('name');
        $user->email = $request->input('email');


        //handle avatar upload (profile img)
        if ($request->hasFile('avatar')) {

            //Delete old avatar if it exists
            if ($user->avatar) {
                Storage::disk('public')->delete($user->avatar);
            }

            //store new avatar img profile
            $avatarPath = $request->file('avatar')->store('avatars', 'public');
            $user->avatar = $avatarPath;
        }

        //UPDATE USER INFO
        $user->save();

        return redirect()->route('dashboard')->with('success', 'Profile info updated');
    }
}
