<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;
use App\Models\Teacher;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class GoogleController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callback()
    {
        try {
            // Get Google user
            $googleUser = Socialite::driver('google')->user();

            // Check if teacher exists by email
            $teacher = Teacher::where('email', $googleUser->getEmail())->first();
            
            if (!$teacher) {
                // Create new teacher
                $teacher = Teacher::create([
                    'email' => $googleUser->getEmail(),
                    'name' => $googleUser->getName(),
                    'username' => explode('@', $googleUser->getEmail())[0],
                    'password' => bcrypt(Str::random(16)),
                ]);
            }

            // Set session with correct primary key
            session([
                'teacher_id' => $teacher->teacher_id, // Now this will work
                'teacher_name' => $teacher->name,
            ]);

            return redirect('/dashboard')->with('success', 'Logged in with Google!');
            
        } catch (\Exception $e) {
            Log::error('Google login error: ' . $e->getMessage());
            return redirect('/login')->with('error', 'Google login failed: ' . $e->getMessage());
        }
    }
}   