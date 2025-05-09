<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Tags\HasTags;

class Question extends Model
{
    /** @use HasFactory<\Database\Factories\QuestionFactory> */
    use HasFactory;
    use HasUlids;
    use SoftDeletes;
    use HasTags;

    protected $fillable = [
        'question',
        'question_type',
        'image',
        'explanation',
        'score',
        'timer',
        'level',
        'teacher_id',
    ];

    protected $casts = [
        'score' => 'integer',
        'timer' => 'integer',
    ];

    // public function getTimerAttribute()
    // {
    //     return Carbon::createFromTimestampMs($this->attributes['timer'])->timestamp;
    // }

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    public function exams()
    {
        return $this->belongsToMany(Exam::class, 'exam_question_paragraph')
            ->withPivot('paragraph_id');
    }

    public function paragraph()
    {
        return $this->belongsToMany(Paragraph::class, 'exam_question_paragraph')
            ->withPivot('exam_id');
    }

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }

    public function examquestionparagraphs()
    {
        return $this->hasMany(ExamQuestionParagraph::class);
    }
}
