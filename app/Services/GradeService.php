<?php
namespace App\Services;

use App\Models\GradingCriteria;
use App\Models\Score;

class GradeService {

    public function computeFinalGrade($student_id, $class_id){
        $criteria = GradingCriteria::where('class_id', $class_id)->get();
        $final = 0;

        foreach($criteria as $c){
            $assessments = $c->assessments;
            $studentTotal = 0;
            $highestTotal = 0;

            foreach($assessments as $a){
                $highestTotal += $a->highest_score;
                $score = Score::where('assessment_id', $a->id)
                        ->where('student_id', $student_id)
                        ->value('score') ?? 0;
                $studentTotal += $score;
            }

            if($highestTotal > 0){
                $componentGrade = ($studentTotal / $highestTotal) * $c->percentage;
                $final += $componentGrade;
            }
        }
        return round($final, 2);
    }

    // -------------------------------
    // Partial grade (midterm or final)
    // -------------------------------
    public function computePartialGrade($student_id, $class_id, $type){
        $criteria = GradingCriteria::where('class_id', $class_id)->get();
        $final = 0;

        foreach($criteria as $c){
            // Only get assessments of the correct type
            $assessments = $c->assessments()
                             ->where('type', $type) // 'midterm' or 'final'
                             ->get();

            $studentTotal = 0;
            $highestTotal = 0;

            foreach($assessments as $a){
                $highestTotal += $a->highest_score;
                $score = Score::where('assessment_id', $a->id)
                        ->where('student_id', $student_id)
                        ->value('score') ?? 0;
                $studentTotal += $score;
            }

            if($highestTotal > 0){
                $componentGrade = ($studentTotal / $highestTotal) * $c->percentage;
                $final += $componentGrade;
            }
        }

        return round($final, 2);
    }
}
