<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:teachers,email',
            'username' => 'required|string|unique:teachers,username',
            'password' => 'required|min:6',
        ]);

        Teacher::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'username' => $request->username,
            'password' => Hash::make($request->password),
        ]);

        return redirect('/login')->with('success', 'Registered successfully');
    }

    public function login(Request $request)
{
    $request->validate([
        'username' => 'required',
        'password' => 'required',
    ]);

    $teacher = Teacher::where('username', $request->username)->first();

    if (!$teacher || !Hash::check($request->password, $teacher->password)) {
        return back()->with('error', 'Invalid credentials');
    }

    // ✅ correct session key + correct ID
    session(['teacher_id' => $teacher->teacher_id]);

    return redirect('/dashboard');
}

    public function logout()
    {
        session()->forget('teacher_id');
        return redirect('/login');
    }
}
