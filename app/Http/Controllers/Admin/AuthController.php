<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // Debug: Check if admin exists
        $admin = Admin::where('email', $credentials['email'])->first();
        
        if (!$admin) {
            Log::error('Admin login failed: User not found', ['email' => $credentials['email']]);
            return back()->withErrors([
                'email' => 'The provided credentials do not match our records.',
            ])->onlyInput('email');
        }

        // Debug: Check password
        $passwordValid = Hash::check($credentials['password'], $admin->password);
        
        if (!$passwordValid) {
            Log::error('Admin login failed: Invalid password', [
                'email' => $credentials['email'],
                'provided_password' => $credentials['password'],
                'stored_hash' => $admin->password
            ]);
            return back()->withErrors([
                'email' => 'The provided credentials do not match our records.',
            ])->onlyInput('email');
        }

        // Login successful
        Auth::guard('admin')->login($admin, $request->boolean('remember'));
        $request->session()->regenerate();
        
        Log::info('Admin login successful', ['email' => $credentials['email']]);
        
        return redirect()->intended(route('admin.dashboard'));
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('admin.login');
    }
}