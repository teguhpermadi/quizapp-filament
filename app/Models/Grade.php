<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    /** @use HasFactory<\Database\Factories\GradeFactory> */
    use HasFactory;
    use HasUlids;

    protected $guarded = [];

    public function students()
    {
        return $this->belongsToMany(Student::class, 'student_grades');
    }

    public function teachers()
    {
        return $this->belongsToMany(Teacher::class, 'subject_teacher_grade')
            ->withPivot('subject_id');
    }

    public function subjects()
    {
        return $this->belongsToMany(Subject::class, 'subject_teacher_grade')
            ->withPivot('teacher_id');
    }

    public function lessons()
    {
        return $this->belongsToMany(Lesson::class, 'lesson_subject_teacher_grade')
            ->withPivot(['subject_id', 'teacher_id']);
    }
}
