<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    // Show login form
    public function showLogin()
    {
        return view('auth.login');
    }

    // Handle login request
    public function login(Request $request)
    {
        // Check if the username tab was used
        if ($request->filled('username')) {
            $request->validate([
                'username' => 'required|string',
                'password' => 'required|min:6',
            ]);

        // Default user data (temporary, no database)
        $defaultUser = (object)[
            'username' => 'kienhaw',
            'email'    => 'kienhaw@gmail.com',
            'password' => 'Kienhaw123!'
        ];

            if ($request->username === $defaultUser->username && $request->password === $defaultUser->password) {
                session(['user' => $defaultUser]);
                return redirect('/')->with('success', 'Login successful');
            }
        }
        // Check if the email tab was used
        elseif ($request->filled('email')) {
            $request->validate([
                'email'    => 'required|email',
                'password' => 'required|min:6',
            ]);

            $defaultUser = (object)[
                'username' => 'kienhaw',
                'email'    => 'kienhaw@gmail.com',
                'password' => 'Kienhaw123!'
            ];

            if ($request->email === $defaultUser->email && $request->password === $defaultUser->password) {
                session(['user' => $defaultUser]);
                return redirect('/')->with('success', 'Login successful');
            }
        }

        return back()->withErrors(['login' => 'Invalid credentials.']);
    }

    // Show register form
    public function showRegister()
    {
        return view('auth.register');
    }

    // Handle registration request (store in session for now)
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
        ]);

        // Store user data in session (temporary)
        $newUser = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password, // No hashing for now
        ];

        session(['user' => $newUser]);

        return redirect()->route('dashboard')->with('success', 'Registration successful');
    }

    // Handle logout
    public function logout()
    {
        session()->forget('user');
        return redirect('/')->with('success', 'Logged out successfully');
    }
}
