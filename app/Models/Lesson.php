<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    /** @use HasFactory<\Database\Factories\LessonFactory> */
    use HasFactory;
    use HasUlids;

    protected $guarded = [];

    public function teachers()
    {
        return $this->belongsToMany(Teacher::class)
            ->withPivot(['subject_id', 'grade_id']);
    }

    public function subjects()
    {
        return $this->belongsToMany(Subject::class)
            ->withPivot(['teacher_id', 'grade_id']);
    }

    public function grades()
    {
        return $this->belongsToMany(Grade::class)
            ->withPivot(['subject_id', 'teacher_id']);
    }
}
