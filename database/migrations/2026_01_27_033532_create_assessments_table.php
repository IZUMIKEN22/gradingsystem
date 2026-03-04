<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('assessments', function(Blueprint $table){
            $table->id();
            $table->foreignId('grading_criteria_id')->constrained('grading_criterias')->onDelete('cascade');
            $table->unsignedBigInteger('class_id'); // Add this line
            $table->string('title');
            $table->integer('highest_score');
            $table->string('type');
            $table->string('date'); // ADD THIS
            $table->timestamps();

            $table->foreign('class_id')->references('class_id')->on('classes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assessments');
    }
};
