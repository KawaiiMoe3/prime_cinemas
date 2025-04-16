<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\User;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'nullable|string',
            'email' => 'nullable|email',
            'password' => 'required|string',
        ]);

        if (!$request->username && !$request->email) {
            return back()->withErrors(['login' => 'Please enter a username or email.']);
        }

        $user = User::where('username', $request->username)
                    ->orWhere('email', $request->email)
                    ->first();

        if (!$user) {
            return back()->withErrors(['login' => 'Invalid Username']);
        }

        Log::info('Entered Password:', ['password' => $request->password]);
        Log::info('Stored Hashed Password:', ['password' => $user->password]);

        if (!Hash::check($request->password, $user->password)) {
            Log::info('Password check result:', ['result' => false]);
            return back()->withErrors(['login' => 'Invalid password']);
        }

        Log::info('Password check result:', ['result' => true]);

        auth()->login($user);

        Session::put('user', [
            'id' => $user->id,
            'username' => $user->username,
            'email' => $user->email
        ]);

        return redirect()->route('index')->with('success', 'Login successful!');
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255|unique:users,username',
            'phone' => 'required|string|max:15',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => [
                'required', 'string', 'min:6', 'confirmed',
                'regex:/^(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{6,}$/'
            ],
        ]);
    
        $phone = $request->phone;
        if ($request->country_code == '+60' && substr($phone, 0, 1) !== '0') {
            $phone = '0' . $phone;
        }
    
        $user = User::create([
            'username' => $request->username,
            'phone' => $phone,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
    
        Auth::login($user);
    
        return redirect()->route('index')->with('success', 'Registration successful!');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        Session::flush();
        return redirect()->route('index')->with('success', 'Logged out successfully.');
    }

}
