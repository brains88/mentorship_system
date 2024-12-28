<?php

namespace App\Http\Controllers\mentee;

use App\Http\Controllers\Controller;
use App\Models\Mentorship;

class BookingsController extends Controller
{
    //
    public function index()
    {
        // Fetch mentor details where mentee_id is the authenticated user
        $mentorships = Mentorship::where('mentorships.mentee_id', auth()->id())
            ->join('users as mentors', 'mentorships.mentor_id', '=', 'mentors.id')
            ->select(
                'mentors.name as mentor_name',
                'mentors.email as mentor_email',
                'mentors.mobile as mentor_mobile',
                'mentors.image as mentor_image',
                'mentorships.status',
                'mentorships.appointment_date',
                'mentorships.appointment_time'
            )
            ->get();

        return view('mentee.bookings', compact('mentorships'));
    }

}