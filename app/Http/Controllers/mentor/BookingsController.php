<?php

namespace App\Http\Controllers\mentor;

use App\Http\Controllers\Controller;
use App\Models\Mentorship;
use Illuminate\Http\Request;

class BookingsController extends Controller
{
    //
    public function index()
    {
        $mentorships = Mentorship::where('mentor_id', auth()->id())
            ->with(['mentee' => function ($query) {
                $query->select('id', 'name', 'email', 'mobile', 'image');
            }])
            ->get();

        return view('mentor.bookings', compact('mentorships'));
    }
    
    public function setTimeSlot(Request $request)
    {
        // Validate the input
        $validated = $request->validate([
            'appointment_date' => 'required|date|after_or_equal:today',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
        ]);

        // Get validated inputs
        $appointmentDate = $validated['appointment_date'];
        $startTime = $validated['start_time'];
        $endTime = $validated['end_time'];

        // Find the mentorship record by mentor_id
        $mentorId = auth()->user()->id;
        $mentorship = Mentorship::where('mentor_id', $mentorId)->first();

        // If no mentorship record exists, create a new one
        if (!$mentorship) {
            $mentorship = new Mentorship();
            $mentorship->mentor_id = $mentorId; // Ensure that mentor_id is set when creating a new record
        }

        // Always update the mentorship record with the new time slot
        $mentorship->appointment_date = $appointmentDate;
        $mentorship->appointment_time = $startTime;
        $mentorship->end_time = $endTime;

        // Save the record (this will update if exists or create a new one)
        $mentorship->save();

        return redirect()->route('mentor.bookings')->with('success', 'Time slot saved successfully.');
    }

}