<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Assessment;
use App\Models\Student;
use App\Models\Score;

class ScoreController extends Controller
{
   public function store(Request $request)
    {
        $request->validate([
            'assessment_id' => 'required|exists:assessments,id',
            'scores' => 'required|array',
            'scores.*' => 'required|numeric|min:0',
        ]);

        $assessmentId = $request->assessment_id;
        $scores = $request->scores; // array: [student_id => score]

        foreach ($scores as $studentId => $scoreValue) {
            \App\Models\Score::updateOrCreate(
                ['student_id' => $studentId, 'assessment_id' => $assessmentId],
                ['score' => $scoreValue]
            );
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Scores saved successfully!'
        ]);
    }
}
