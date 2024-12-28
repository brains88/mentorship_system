<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Mentorship;
use App\Models\User;

class DashboardController extends Controller
{
    //
    public function index()
    {

        $users = User::where('role', '!=', 'admin')->get();

        // Count the number of accepted appointments (mentorships with 'accepted' status)
        $appointments = Mentorship::count();

        // Return the view and pass the mentees and appointments to it
        return view('admin.dashboard', compact('users', 'appointments'));
    }
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        // Optional: Check if the user has related data to delete
        // $user->relatedData()->delete();

        $user->delete();

        return redirect()->back()->with('success', 'User deleted successfully.');
    }
}