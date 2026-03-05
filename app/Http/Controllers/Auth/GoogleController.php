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
            // Debug: Log that we hit the callback
            Log::info('Google callback reached');
            
            // Get Google user WITHOUT stateless()
            $googleUser = Socialite::driver('google')->user();
            
            // Debug: Log Google user data
            Log::info('Google user data:', [
                'email' => $googleUser->getEmail(),
                'name' => $googleUser->getName(),
                'id' => $googleUser->getId()
            ]);

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
                Log::info('New teacher created:', ['id' => $teacher->teacher_id]);
            } else {
                Log::info('Existing teacher found:', ['id' => $teacher->teacher_id]);
            }

            // Set session explicitly
            session()->put('teacher_id', $teacher->teacher_id);
            session()->put('teacher_name', $teacher->name);
            session()->save(); // Force session save
            
            Log::info('Session data set:', session()->all());

            return redirect('/dashboard')->with('success', 'Logged in with Google!');
            
        } catch (\Exception $e) {
            // Log the full error
            Log::error('Google login error: ' . $e->getMessage());
            Log::error('Error trace: ' . $e->getTraceAsString());
            
            // Return error message
            return response()->json([
                'error' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString()
            ], 500);
        }
    }
}