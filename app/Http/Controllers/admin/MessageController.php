<?php

namespace App\Http\Controllers\mentor;

use App\Http\Controllers\Controller;
use App\Models\Mentorship;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class MessageController extends Controller
{

    public function index()
    {
        // Fetch the mentorship data for the authenticated user (mentee)
        $mentorships = Mentorship::where('mentee_id', Auth::id())
            ->with('mentor') // Eager load the mentor data
            ->get();

        // Assuming you want the first mentor in the list
        $mentor = $mentorships->first()->mentor ?? null;

        // Fetch messages for the first mentor (if it exists)
        $messages = $mentor ? Message::where(function ($query) use ($mentor) {
            $query->where('sender_id', Auth::id())
                ->where('receiver_id', $mentor->id);
        })
            ->orWhere(function ($query) use ($mentor) {
                $query->where('sender_id', $mentor->id)
                    ->where('receiver_id', Auth::id());
            })
            ->orderBy('created_at', 'asc')
            ->get() : collect(); // Return an empty collection if no mentor exists

        return view('mentee.chat', compact('mentorships', 'mentor', 'messages'));
    }

    public function fetchMessages($mentor_id)
    {
        $messages = Message::where(function ($query) use ($mentor_id) {
            $query->where('sender_id', Auth::id())
                ->where('receiver_id', $mentor_id);
        })
            ->orWhere(function ($query) use ($mentor_id) {
                $query->where('sender_id', $mentor_id)
                    ->where('receiver_id', Auth::id());
            })
            ->orderBy('created_at', 'asc')
            ->get();

        return response()->json($messages);
    }

    public function sendMessage(Request $request, $mentor_id)
    {
        // Log message sending attempt
        Log::info('Attempting to send message from user ' . Auth::id() . ' to mentor ' . $mentor_id);

        $message = Message::create([
            'sender_id' => Auth::id(),
            'receiver_id' => $mentor_id,
            'message' => $request->message,
            'is_read' => 0, // Explicitly set is_read to 0
        ]);

        // Log success
        Log::info('Message sent successfully:', ['message' => $message]);

        return response()->json($message);
    }
}