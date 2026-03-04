<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AcademicYear;

class AcademicYearController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'academic_year' => 'required|unique:academic_years,academic_year'
        ]);

        AcademicYear::create([
            'academic_year' => $request->academic_year
        ]);

        return back()->with('success', 'Academic Year Added');
    }
}
