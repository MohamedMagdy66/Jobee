<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class EmployerController extends Controller
{
    public function EditEmployer()
    {
        $user = Auth::user();
        if ($user) {
            return view('auth.editEmployer', ['user' => $user]);
        }
        return redirect('/login');
    }

    public function updateName(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'name' => 'required|string|max:255', // Validate user name
            'employer_name' => 'required|string|max:255', // Validate employer name
        ]);

        // Retrieve the currently authenticated user
        $user = Auth::user();

        // Update the user's name
        $user->name = $request->input('name');

        // Update the employer's name if the user has an employer
        if ($user->employer) {
            $user->employer->name = $request->input('employer_name');
        }

        // Save the updated user object
        if ($user->save() && ($user->employer ? $user->employer->save() : true)) {
            // Redirect to the dashboard with a success message
            return redirect('/dashboard')->with('success', 'Names updated successfully.');
        }

        // Redirect back with an error message if save fails
        return redirect()->back()->with('error', 'Failed to update names. Please try again.');
    }

    public function editPassword()
    {
        $user = Auth::user();
        if ($user) {
            return view('auth.editPassword', ['user' => $user]);
        }
        return redirect('/dashboard');
    }

    public function updatePassword(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'oldPassword' => 'required|string',
            'newPassword' => 'required|string|min:8|confirmed', // Ensure new password is confirmed
        ]);

        // Get the currently authenticated user
        $user = Auth::user();

        // Check if the old password matches the current password in the database
        if (!Hash::check($request->oldPassword, $user->password)) {
            return back()->withErrors(['oldPassword' => 'The provided password does not match your current password.']);
        }

        // Update the user's password
        $user->password = Hash::make($request->newPassword);
        $user->save();

        // Redirect back with a success message
        return redirect("/dashboard")->with('success', 'Your password has been updated successfully.');
    }
}
