<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PasswordController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth'); // Apply the 'auth' middleware to ensure user is logged in
    // }
    public function showChangeForm()
    {
        return view('auth.passwords.change');
        // return 'ok';
    }

    public function change(Request $request)
    {
        // Validate the password change form data
        $this->validate($request, [
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Update the user's password
        $user = auth()->user();
        $user->password = bcrypt($request->input('password'));
        $user->password_changed = true;
        $user->save();

        // Redirect the user to the home page with a success message
        return redirect()->route('home')->with('success', 'Password changed successfully.');
    }
}
