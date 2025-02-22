<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class SubjectTeacherGrade extends Model
{
    protected $table = 'subject_teacher_grade';

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    public function grade()
    {
        return $this->belongsTo(Grade::class);
    }

    public function scopeMyGrades(Builder $builder): void
    {
        $teacher_id = auth()->user()?->userable->userable_id;

        if(!$teacher_id) {
            abort('403', 'unautorized');
        }

        $builder->where('teacher_id', $teacher_id);
    }

    public function scopeMySubjects(Builder $builder): void
    {
        $teacher_id = auth()->user()?->userable->userable_id;   

        if(!$teacher_id) {
            abort('403', 'unautorized');
        }

        $builder->where('teacher_id', $teacher_id);
    }
}
