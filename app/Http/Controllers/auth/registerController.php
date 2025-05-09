<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Models\{User,Mentorship};
use Illuminate\Http\Request;
use Hash;
use Illuminate\Support\Facades\Log;
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
                'mobile' => 'required|string|max:15|unique:users',
                'password' => 'required|string|min:8',
                'interests' => 'required|array|min:1|max:3',
                'interests.*' => 'string|max:255',
                'profile_image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
                'role' => 'required|in:mentor,mentee',
            ]);
    
            // Validate mentor has exactly one interest
            if ($validatedData['role'] === 'mentor' && count($validatedData['interests']) !== 1) {
                throw ValidationException::withMessages([
                    'interests' => 'Mentors must have exactly one area of interest'
                ]);
            }
    


            // Store profile image
            $profileImagePath = $request->file('profile_image')->store('profile_images', 'public');
    
            // Create user
            $user = User::create([
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'mobile' => $validatedData['mobile'],
                'password' => Hash::make($validatedData['password']),
                'role' => $validatedData['role'],
                'image' => $profileImagePath,
                'interests' => $validatedData['interests'],
            ]);
    
            // Assign mentors if mentee
            if ($user->role === 'mentee') {
                $this->assignMatchingMentors($user);
            }
    
            return response()->json([
                'success' => true,
                'message' => 'Registration successful! Redirecting to login...',
                'redirect_url' => route('login'),
            ]);
    
        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'errors' => $e->errors(),
            ], 422);
        } catch (Exception $e) {
            Log::error('Registration error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Registration failed. Please try again.',
            ], 500);
        }
    }

    protected function assignMatchingMentors(User $mentee)
    {
        $menteeInterests = $mentee->interests ?? [];
        
        foreach ($menteeInterests as $interest) {
            // Find available mentor with this exact interest
            $mentor = User::where('role', 'mentor')
                ->where(function($query) use ($interest) {
                    // Handle both JSON array and string formats
                    $query->whereJsonContains('interests', $interest)
                          ->orWhere('interests', 'like', '%"'.$interest.'"%');
                })
                ->whereDoesntHave('mentorships', function ($query) use ($mentee) {
                    $query->where('mentee_id', $mentee->id);
                })
                ->withCount(['mentorships as active_mentorships' => function($query) {
                    $query->where('status', 'active');
                }])
                ->having('active_mentorships', '<', 5) // Limit to 5 active mentees
                ->inRandomOrder()
                ->first();
    
            if ($mentor) {
                Mentorship::create([
                    'mentor_id' => $mentor->id,
                    'mentee_id' => $mentee->id,
                    'status' => 'pending',
                    'matched_interest' => $interest
                ]);
                
                // Optional: Send notification to mentor
                // $mentor->notify(new NewMentorshipRequest($mentee));
            } else {
                Log::info("No available mentor found for interest: {$interest}");
                // You might want to queue this for later matching
                // or notify admin about unmet demand
            }
        }
    }
}
