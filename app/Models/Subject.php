<?php

namespace App\Models;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    /** @use HasFactory<\Database\Factories\SubjectFactory> */
    use HasFactory;
    use HasUlids;

    protected $guarded = [];

    public function teachers()
    {
        return $this->belongsToMany(Teacher::class, 'subject_teacher_grade')
            ->withPivot('grade_id');
    }

    public function grades()
    {
        return $this->belongsToMany(Grade::class, 'subject_teacher_grade')
            ->withPivot('teacher_id');
    }

    public function lessons()
    {
        return $this->belongsToMany(Lesson::class, 'lesson_subject_teacher_grade')
            ->withPivot(['teacher_id', 'grade_id']);
    }

    public function scopeMySubjects(Builder $builder): void
    {
        $teacher_id = auth()->user()?->userable->userable_id;

        if(!$teacher_id) {
            abort('403', 'unautorized');
        }

        $builder->whereHas('teachers', function ($query) use ($teacher_id) {
            $query->where('teacher_id', $teacher_id);
        });
    }   
}
