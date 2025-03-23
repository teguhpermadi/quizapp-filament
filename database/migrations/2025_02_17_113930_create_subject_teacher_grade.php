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
        Schema::create('subject_teacher_grade', function (Blueprint $table) {
            $table->foreignUlid('subject_id')->constrained()->onDelete('cascade');
            $table->foreignUlid('teacher_id')->constrained()->onDelete('cascade');
            $table->foreignUlid('grade_id')->constrained()->onDelete('cascade');
            $table->primary(['subject_id', 'teacher_id', 'grade_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subject_teacher_grade');
    }
};
