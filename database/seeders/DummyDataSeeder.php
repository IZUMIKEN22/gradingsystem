<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DummyDataSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Classes
        $grade10A = DB::table('classes')->insertGetId(['name' => 'Grade 10 - A']);
        $grade10B = DB::table('classes')->insertGetId(['name' => 'Grade 10 - B']);

        // 2. Students
        $juan = DB::table('students')->insertGetId(['first_name' => 'Juan', 'last_name' => 'Dela Cruz', 'class_id' => $grade10A]);
        $maria = DB::table('students')->insertGetId(['first_name' => 'Maria', 'last_name' => 'Santos', 'class_id' => $grade10A]);
        $pedro = DB::table('students')->insertGetId(['first_name' => 'Pedro', 'last_name' => 'Reyes', 'class_id' => $grade10B]);
        $ana = DB::table('students')->insertGetId(['first_name' => 'Ana', 'last_name' => 'Lopez', 'class_id' => $grade10B]);

        // 3. Grading Criteria
        $quiz = DB::table('grading_criterias')->insertGetId(['class_id' => $grade10A, 'component_name' => 'Quiz', 'percentage' => 30]);
        $exam = DB::table('grading_criterias')->insertGetId(['class_id' => $grade10A, 'component_name' => 'Exam', 'percentage' => 70]);

        // 4. Assessments
        $q1 = DB::table('assessments')->insertGetId(['grading_criteria_id' => $quiz, 'title' => 'Quiz 1', 'highest_score' => 20]);
        $q2 = DB::table('assessments')->insertGetId(['grading_criteria_id' => $quiz, 'title' => 'Quiz 2', 'highest_score' => 25]);
        $mid = DB::table('assessments')->insertGetId(['grading_criteria_id' => $exam, 'title' => 'Midterm Exam', 'highest_score' => 50]);
        $final = DB::table('assessments')->insertGetId(['grading_criteria_id' => $exam, 'title' => 'Final Exam', 'highest_score' => 100]);

        // 5. Scores
        DB::table('scores')->insert([
            // Quiz 1
            ['assessment_id' => $q1, 'student_id' => $juan, 'score' => 18],
            ['assessment_id' => $q1, 'student_id' => $maria, 'score' => 20],
            ['assessment_id' => $q1, 'student_id' => $pedro, 'score' => 15],
            ['assessment_id' => $q1, 'student_id' => $ana, 'score' => 19],

            // Quiz 2
            ['assessment_id' => $q2, 'student_id' => $juan, 'score' => 22],
            ['assessment_id' => $q2, 'student_id' => $maria, 'score' => 25],
            ['assessment_id' => $q2, 'student_id' => $pedro, 'score' => 20],
            ['assessment_id' => $q2, 'student_id' => $ana, 'score' => 23],

            // Midterm Exam
            ['assessment_id' => $mid, 'student_id' => $juan, 'score' => 45],
            ['assessment_id' => $mid, 'student_id' => $maria, 'score' => 48],
            ['assessment_id' => $mid, 'student_id' => $pedro, 'score' => 40],
            ['assessment_id' => $mid, 'student_id' => $ana, 'score' => 47],

            // Final Exam
            ['assessment_id' => $final, 'student_id' => $juan, 'score' => 85],
            ['assessment_id' => $final, 'student_id' => $maria, 'score' => 90],
            ['assessment_id' => $final, 'student_id' => $pedro, 'score' => 75],
            ['assessment_id' => $final, 'student_id' => $ana, 'score' => 88],
        ]);
    }
}
