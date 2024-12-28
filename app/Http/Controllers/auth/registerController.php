<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    //

    public function index()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users',
                'mobile' => 'required|string|max:15',
                'password' => 'required|string|min:8',
                'special_field' => 'required|string',
                'profile_image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
                'role' => 'required|in:mentor,mentee',
            ]);

            $profileImage = $request->file('profile_image')->store('profile_images', 'public');

            User::create([
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'mobile' => $validatedData['mobile'],
                'password' => bcrypt($validatedData['password']),
                'area_of_interest' => $validatedData['special_field'],
                'role' => $validatedData['role'],
                'image' => $profileImage,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Registration successful',
                'redirect_url' => route('login'),
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'errors' => $e->errors(),
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred during registration. Please try again.',
            ], 500);
        }
    }

}
