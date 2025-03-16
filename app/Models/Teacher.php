<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    /** @use HasFactory<\Database\Factories\TeacherFactory> */
    use HasFactory;
    use HasUlids;

    protected $fillable = [
        'name',
    ];

    public function userable()
    {
        return $this->morphOne(Userable::class, 'userable');
    }
    public function subjects()
    {
        return $this->belongsToMany(Subject::class, 'subject_teacher_grade')
            ->withPivot('grade_id');
    }

    public function grades()
    {
        return $this->belongsToMany(Grade::class, 'subject_teacher_grade')
            ->withPivot('subject_id');
    }

    public function lessons()
    {
        return $this->belongsToMany(Lesson::class, 'lesson_subject_teacher_grade')
            ->withPivot(['subject_id', 'grade_id']);
    }
}
