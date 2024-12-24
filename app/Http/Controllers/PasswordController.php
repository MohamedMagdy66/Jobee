<?php

namespace App\Http\Controllers;

use App\Jobs\SendPasswordResetLink;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class PasswordController extends Controller
{
    // show the password reset form
    public function showResetRequestForm()
    {
        return view('auth.forgetPassword');
    }

    // check if the email is exist in the db and send the reset link
    public function sendResetLink(Request $request)
    {
        //ini_set('max_execution_time', 3600);
        // Validate the email input
        $request->validate(['email' => ['required', 'email']]);
        // check if the email is exist in the db
        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return back()->withErrors(['email' => 'Email not found']);
        }
        // send the password reset link
        $status = Password::sendResetLink($request->only('email'));
        return $status === Password::RESET_LINK_SENT
            ? back()->with(['status' => __('A password reset link has been sent to your email address.')])
            : back()->withErrors(['email' => __('There was an error sending the password reset link. Please try again.')]);
    }
    public function showResetForm(Request $request, $token = null)
    {
        return view('auth.passwordReset', ['token' => $token, 'email' => $request->email]);
    }

    public function NewPassword(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:8|confirmed', // Ensure password is confirmed and has a minimum length
            'token' => 'required|string'
        ]);

        // Find the user by email
        $user = User::where('email', $request->email)->first();

        // Check if the user exists and the token is valid
        if (!$user || !Password::tokenExists($user, $request->token)) {
            return back()->withErrors(['email' => 'Invalid token or email.']);
        }

        // Update the user's password within a transaction
        DB::transaction(function () use ($user, $request) {
            $user->password = Hash::make($request->password); // Hash the new password
            $user->save(); // Save the user
        });

        // Log the password reset action
        Log::info('Password reset for user: ' . $user->email);

        // Optionally, you can log the user in after resetting the password
        // Auth::login($user);

        return redirect('/login')->with('status', 'Your password has been reset successfully.');
    }
}
