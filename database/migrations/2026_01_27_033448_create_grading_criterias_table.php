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
        Schema::create('grading_criterias', function (Blueprint $table){
            $table->id();
            $table->unsignedBigInteger('class_id'); // must match type of classes.class_id
            $table->string('component_name');
            $table->integer('percentage'); // 0-100
            $table->timestamps();

            // Foreign key explicitly referencing class_id
            $table->foreign('class_id')
                ->references('class_id') // matches classes primary key
                ->on('classes')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('grading_criterias');
    }
};
