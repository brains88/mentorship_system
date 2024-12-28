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
        // Get the authenticated mentor's ID
        $mentorId = auth()->id();

        // Fetch all mentees who have chosen this mentor and the status of their mentorship request
        $mentees = Mentorship::where('mentor_id', $mentorId)
            ->with('mentee') // Assuming the relationship is defined
            ->get();

        // Count the number of accepted appointments (mentorships with 'accepted' status)
        $appointments = $mentees->where('status', 'accepted')->count();

        // Return the view and pass the mentees and appointments to it
        return view('mentor.dashboard', compact('mentees', 'appointments'));
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