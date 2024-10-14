<?php

namespace App\Http\Controllers\frontend;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\QueryException;
use Illuminate\Validation\ValidationException;


class AuthController extends Controller
{
    public function registerForm(){
        return view('frontend.pages.registration');
    }

    public function register(Request $request)
    {
        // Validate form inputs
        $validated = $request->validate([
            'company_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'mobile' => 'required|numeric|digits:11',
            'password' => 'required|string|min:8|confirmed',
        ]);

        try {
            // Create a new user record
            $user = new User();
            $user->company_name = $request->company_name;
            $user->email = $request->email;
            $user->mobile = $request->mobile;
            $user->password = Hash::make($request->password);
            $user->status = 'pending';  // Set initial status to pending
            $user->save();

            // Assign the role using Laratrust
            $user->attachRole('seller');

            return redirect()->back()->with('message', 'Registration Successful!');
        } catch (QueryException $e) {
            if ($e->errorInfo[1] == 1062) {
                return redirect()->back()->withInput()->withErrors(['email' => 'The email address is already registered.']);
            }

            return redirect()->back()->withErrors(['error' => 'Something went wrong! Please try again.']);
        }
    }

    public function loginForm(){
        return view('frontend.pages.login');
    }

    public function login(Request $request)
    {
        try {
            // Validate the login request
            $request->validate([
                'email' => 'required|email',
                'password' => 'required',
            ]);

            // Check if the user exists
            $user = User::where('email', $request->email)->first();

            if (!$user) {
                throw ValidationException::withMessages([
                    'email' => ['This email is not registered.'],
                ]);
            }

            // Attempt to log the user in
            if (Auth::attempt($request->only('email', 'password'), $request->filled('remember'))) {
                    return redirect()->intended('admin/dashboard');

                // If the user is not an admin, log them out and return error
                Auth::logout();
                throw ValidationException::withMessages([
                    'email' => ['You do not have admin access.'],
                ]);
            }

            // If login fails, throw a validation exception
            throw ValidationException::withMessages([
                'email' => [trans('auth.failed')],
            ]);

        } catch (\Exception $e) {
            // Handle any unexpected exceptions
            return back()->withErrors(['error' => 'Something went wrong! Please try again.']);
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }



}
