<?php

namespace App\Models;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    /** @use HasFactory<\Database\Factories\LessonFactory> */
    use HasFactory;
    use HasUlids;

    protected $fillable = [
        'title',
    ];

    public function teachers()
    {
        return $this->belongsToMany(Teacher::class, 'lesson_subject_teacher_grade')
            ->withPivot(['subject_id', 'grade_id']);
    }

    public function subjects()
    {
        return $this->belongsToMany(Subject::class, 'lesson_subject_teacher_grade')
            ->withPivot(['teacher_id', 'grade_id']);
    }

    public function grades()
    {
        return $this->belongsToMany(Grade::class, 'lesson_subject_teacher_grade')
            ->withPivot(['subject_id', 'teacher_id']);
    }

    public function scopeMyLessons(Builder $builder): void
    {
        $teacher_id = auth()->user()?->userable->userable_id;

        if(!$teacher_id) {
            abort('403', 'unautorized');
        }

        $builder->whereHas('teachers', function ($query) use ($teacher_id) {
            $query->where('teacher_id', $teacher_id);
        });
    }

    public function exercises()
    {
        return $this->hasMany(Exercise::class);
    }
}
