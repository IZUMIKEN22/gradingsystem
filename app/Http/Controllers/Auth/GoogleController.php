<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;
use App\Models\Teacher; // Make sure this is your model
use Illuminate\Support\Str;

class GoogleController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callback()
    {
        // Get Google user
        $googleUser = Socialite::driver('google')->stateless()->user();

        // Check if teacher exists by email
        $teacher = Teacher::firstOrCreate(
            ['email' => $googleUser->getEmail()], // look up by email
            [
                'name' => $googleUser->getName(), // create if not exists
                'username' => explode('@', $googleUser->getEmail())[0],
                'password' => bcrypt(Str::random(16)), // random password
            ]
        );

        // Set session for middleware
        session([
            'teacher_id'   => $teacher->teacher_id, // match your DB PK
            'teacher_name' => $teacher->name,
        ]);

        return redirect('/dashboard')->with('success', 'Logged in with Google!');
    }
}
