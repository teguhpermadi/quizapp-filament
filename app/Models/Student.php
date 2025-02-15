<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    /** @use HasFactory<\Database\Factories\StudentFactory> */
    use HasFactory;
    use HasUlids;

    protected $guarded = [];

    public function userable()
    {
        return $this->morphOne(Userable::class, 'userable');
    }

    public function grades()
    {
        return $this->belongsToMany(Grade::class, 'student_grades');
    }
}
