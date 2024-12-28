<?php

namespace App\Http\Controllers\mentee;

use App\Http\Controllers\Controller;
use App\Models\Mentorship;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{
    //
    public function index()
    {
        $mentors = User::where('role', 'mentor')->get();
        $appointments = Mentorship::where('mentorships.mentee_id', auth()->id())->where('status', 'accepted')->count();
        return view('mentee.dashboard', compact('mentors', 'appointments'));
    }

    public function toggleMentor($mentorId)
    {
        $menteeId = auth()->id(); // Assuming authentication

        // Find existing mentorship record
        $mentorship = Mentorship::where('mentor_id', $mentorId)
            ->where('mentee_id', $menteeId)
            ->first();

        if ($mentorship) {
            // Delete the mentorship record if it exists
            $mentorship->delete();

            return response()->json([
                'message' => 'Mentor unselected successfully',
                'status' => 'unselected',
            ]);
        } else {
            // Create a new mentorship record
            Mentorship::create([
                'mentor_id' => $mentorId,
                'mentee_id' => $menteeId,
            ]);

            return response()->json([
                'message' => 'Mentor selected successfully',
            ]);
        }
    }

    //User Profile

    public function updatePassword(Request $request)
    {
        $user = Auth::user();

        if (!$user) {
            return response()->json([
                'message' => 'User not authenticated',
            ], 401);
        }

        // Validate request data
        $request->validate([
            'newPassword' => 'required|string|min:8|confirmed', // Ensure password confirmation is sent as 'password_confirmation'
        ]);

        // Update the user's password
        $user->password = Hash::make($request->password);
        $user->save();

        return response()->json([
            'message' => 'Password updated successfully!',
        ]);
    }

}