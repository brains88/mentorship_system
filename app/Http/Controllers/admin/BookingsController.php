<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Mentorship;

class BookingsController extends Controller
{
    //
    public function index()
    {
        $mentorships = Mentorship::with(['mentor:id,name,email,mobile,image', 'mentee:id,name,email,mobile,image'])->get();

        return view('admin.bookings', compact('mentorships'));
    }

    public function destroy($id)
    {
        $mentorship = Mentorship::findOrFail($id);
        $mentorship->delete();

        return redirect()->back()->with('success', 'Mentorship deleted successfully.');
    }

}