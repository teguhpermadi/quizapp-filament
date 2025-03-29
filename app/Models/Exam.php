<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Exam extends Model
{
    /** @use HasFactory<\Database\Factories\ExamFactory> */
    use HasFactory;
    use HasUlids;
    use SoftDeletes;

    protected $fillable = [
        'teacher_id',
        'title',
        'image',
        'description',
    ];

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    public function questions()
    {
        return $this->belongsToMany(Question::class, 'exam_question_paragraph')
            ->withPivot('paragraph_id');
    }

    public function paragraphs()
    {
        return $this->belongsToMany(Paragraph::class, 'exam_question_paragraph')
            ->withPivot('question_id');
    }

    public function examquestionparagraphs()
    {
        return $this->hasMany(ExamQuestionParagraph::class);
    }
}
