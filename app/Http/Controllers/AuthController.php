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

        if (! $request->filled('username') && ! $request->filled('email')) {
            return back()
                ->withInput()
                ->withErrors(['login' => 'Please enter either a username or email.']);
        }

        $field = $request->filled('username') ? 'username' : 'email';
        $value = $request->input($field);

        $user = User::where($field, $value)->first();
        if (! $user) {
            // attach error to the *same* input name
            return back()
                ->withInput()
                ->withErrors([ $field => "No account found with that {$field}.", ]);
        }

        if (! Hash::check($request->password, $user->password)) {
            return back()
                ->withInput()
                ->withErrors(['password' => 'Invalid password.']);
        }

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

    protected function generateCardNumber()
    {
        do {
            $number = random_int(10000000000000, 99999999999999);
        } while (User::where('card_number', $number)->exists());
    
        return (string) $number;
    }

    public function register(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255|unique:users,username',
            'phone'    => 'required|string|max:15',
            'email'    => 'required|email|max:255|unique:users,email',
            'password' => [
                'required','string','min:6','confirmed',
                'regex:/^(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&]).+$/'
            ],
        ]);

        $phone = $request->phone;
        if ($request->country_code == '+60' && substr($phone, 0, 1) !== '0') {
            $phone = '0'.$phone;
        }

        $user = User::create([
            'username'    => $request->username,
            'phone'       => $phone,
            'email'       => $request->email,
            'password'    => Hash::make($request->password),
            'card_number' => $this->generateCardNumber(),
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
