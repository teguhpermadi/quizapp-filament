<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentGrade extends Model
{
    protected $fillable = [
        'student_id',
        'grade_id'
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function grade()
    {
        return $this->belongsTo(Grade::class);
    }
}
