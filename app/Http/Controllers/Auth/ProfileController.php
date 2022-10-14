<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ProfileUpdateRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function show()
    {
        $user = Auth::user();

        return view('profile.show', compact('user'));
    }
    public function edit()
    {
        //Returns the Active that you selected
        $user = Auth::user();

        return view('profile.edit', compact('user'));
    }
    public function update(ProfileUpdateRequest $request)
    {
        //Updates the Active

        $user = Auth::user();

        $user->name = $request->name;
        $user->email = $request->email;
        if (!empty($request->password)) {
            $user->password = Hash::make($request->password);
        }
        $user->save();

        return redirect()->route('profile')->with('status', 'Profile succesfully updated');
    }
}
