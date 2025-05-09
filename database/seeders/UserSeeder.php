<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as FakerFactory; // Add this import

class UserSeeder extends Seeder
{
    public function run()
    {
        $faker = FakerFactory::create();
        $interests = [
            'Web Development',
            'Mobile Development',
            'Data Science',
            'Artificial Intelligence',
            'Machine Learning',
            'Cybersecurity',
            'Cloud Computing',
            'UI/UX Design',
            'Digital Marketing',
            'Entrepreneurship'
        ];
    
        // Create admin
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password123'),
            'interests' => ['management'],
            'mobile' => '1234567890',
            'role' => 'admin',
        ]);
    
        // Create mentors (each with exactly one interest)
        foreach ($interests as $interest) {
            User::factory()->create([
                'role' => 'mentor',
                'interests' => [$interest],
                'mobile' => $faker->unique()->phoneNumber,
                'image'=>'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ8XpWWRtPUjhZ7MuHF8i4KDIxQOxDfkGMxYw&s',

            ]);
        }
    
        // Create mentees (with 1-3 interests)
        User::factory()->count(10)->create([
            'role' => 'mentee'
        ])->each(function ($user) use ($interests, $faker) {
            $user->interests = $faker->randomElements($interests, $faker->numberBetween(1, 3));
            $user->save();
        });
    }
}