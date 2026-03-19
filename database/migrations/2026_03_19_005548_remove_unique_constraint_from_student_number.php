<?php
// database/migrations/2024_xx_xx_xxxxxx_remove_unique_constraint_from_student_number.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveUniqueConstraintFromStudentNumber extends Migration
{
    public function up()
    {
        Schema::table('student_list', function (Blueprint $table) {
            // Drop the unique constraint on student_number
            $table->dropUnique('student_list_student_number_unique');
            
            // Add composite unique constraint (student_number + class_id)
            // This prevents duplicates in the SAME class but allows in DIFFERENT classes
            $table->unique(['student_number', 'class_id'], 'student_number_class_unique');
        });
    }

    public function down()
    {
        Schema::table('student_list', function (Blueprint $table) {
            $table->dropUnique('student_number_class_unique');
            $table->unique('student_number', 'student_list_student_number_unique');
        });
    }
}