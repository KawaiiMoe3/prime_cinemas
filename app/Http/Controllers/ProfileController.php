<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class ProfileController extends Controller
{
    public function showProfile()
    {
        $user = Auth::user();
    
        if (!$user) {
            return redirect()->route('login')->with('error', 'You need to log in first.');
        }
    
        return view('profile.my_profile', compact('user'));
    }

    public function edit()
    {
        $user = auth()->user();
        return view('profile.edit', compact('user'));
    }

    public function updateMobile(Request $request)
    {
        $user = User::find(Auth::id());
    
        if (!$user) {
            return response()->json(['success' => false, 'message' => 'User not authenticated']);
        }
    
        $request->validate([
            'phone' => 'required|min:10|max:15'
        ]);
    
        $user->phone = $request->phone;
        $user->save();
    
        return response()->json(['success' => true, 'message' => 'Mobile number updated successfully']);
    }

    public function updateEmail(Request $request)
    {
        $user = User::find(Auth::id());

        if (!$user) {
            return response()->json(['success' => false, 'message' => 'User not authenticated']);
        }

        $request->validate([
            'email' => 'required|email|unique:users,email'
        ]);

        $user->email = $request->email;
        $user->save();

        return response()->json(['success' => true, 'message' => 'Email updated successfully']);
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();
        if (!$user) {
            return response()->json(['success' => false, 'message' => 'User not authenticated']);
        }
    
        $validated = $request->validate([
            'username' => 'required|string|max:255|unique:users,username,' . $user->id,
            'dob'      => 'sometimes|nullable|date',
            'state'    => 'sometimes|nullable|string|max:255',
            'district' => 'sometimes|nullable|string|max:255',
            'gender'   => 'sometimes|nullable|in:Male,Female',
        ]);

        $updateData = ['username' => $validated['username']];
        foreach (['dob','state','district','gender'] as $field) {
            if (array_key_exists($field, $validated)) {
                $updateData[$field] = $validated[$field];
            }
        }
    
        $user->update($updateData);
    
        return response()->json(['success' => true, 'message' => 'Profile updated successfully!']);
    }
}

