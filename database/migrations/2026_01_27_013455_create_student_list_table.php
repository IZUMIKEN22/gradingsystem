<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('student_list', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('class_id');
            $table->string('reg_number')->nullable();       // Reg #
            $table->string('student_number')->unique();    // Student #
            $table->string('student_name');

            $table->string('barangay')->nullable();
            $table->string('city')->nullable();             // City / Municipality
            $table->string('province')->nullable();

            $table->date('date_of_birth')->nullable();
            $table->enum('sex', ['Male', 'Female'])->nullable();

            $table->string('mobile_number')->nullable();
            $table->string('email')->nullable();

            $table->timestamps();

            $table->foreign('class_id')
                ->references('class_id')
                ->on('classes')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('student_list');
    }
};
