<?php

namespace App\Models;

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
        return $this->belongsToMany(Teacher::class)
            ->withPivot('grade_id');
    }

    public function grades()
    {
        return $this->belongsToMany(Grade::class)
            ->withPivot('teacher_id');
    }

    public function lessons()
    {
        return $this->belongsToMany(Lesson::class)
            ->withPivot(['teacher_id', 'grade_id']);
    }
}
