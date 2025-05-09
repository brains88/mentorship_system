<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable
{
    use HasFactory;

    protected $fillable = ['name', 'email', 'password','mobile','interests','image','role'];

    protected $casts = [
        'interests' => 'array', // Automatically converts between JSON and PHP array
    ];

    public function mentorships()
    {
        return $this->hasMany(Mentorship::class, 'mentee_id'); // Mentee's mentorships
    }

    public function bookedAppointments()
    {
        return $this->hasMany(Booking::class, 'mentee_id'); // Appointments booked by the user
    }

    public function messages()
    {
        return $this->hasMany(Message::class, 'sender_id'); // Messages sent by the user
    }

}
