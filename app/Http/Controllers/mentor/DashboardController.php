<?php

namespace App\Http\Controllers\mentor;

use App\Http\Controllers\Controller;
use App\Models\Mentorship;
use Auth;

class DashboardController extends Controller
{
    //
    public function index()
    {
        $mentor = auth()->user(); // Get the authenticated mentor
        
        // Fetch all mentees who have chosen this mentor with their mentorship status
        $mentees = Mentorship::where('mentor_id', $mentor->id)
            ->with(['mentee' => function($query) {
                $query->select('id', 'name', 'email', 'interests','image');
            }])
            ->get();
    
        // Count accepted appointments
        $appointments = $mentees->where('status', 'accepted')->count();
    
        return view('mentor.dashboard', [
            'mentees' => $mentees,
            'appointments' => $appointments,
            'mentorInterests' => $mentor->interests ?? [] // Pass mentor's interests to view
        ]);
    }

    public function toggleStatus($id)
    {
        $mentorship = Mentorship::findOrFail($id);

        // Toggle the status between 'accepted' and 'rejected'
        $mentorship->status = $mentorship->status == 'accepted' ? 'rejected' : 'accepted';
        $mentorship->save();

        return response()->json([
            'status' => $mentorship->status,
        ]);
    }
}