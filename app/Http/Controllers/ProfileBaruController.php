<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function update(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . Auth::user()->id,
            // Add more validation rules for other profile fields as needed
        ]);

        // Update the user's profile data
        $user = Auth::user();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        // Update other profile fields as needed
        $user->save();

        // Redirect back to the dashboard or profile page
        // For example, if you have a named route for the dashboard, you can use:
        return redirect()->route('dashboard')->with('success', 'Profile updated successfully!');
    }
}