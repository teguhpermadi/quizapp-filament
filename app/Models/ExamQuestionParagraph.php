<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;

class ExamQuestionParagraph extends Model
{
    use HasUlids;
    
    protected $table = 'exam_question_paragraph';

    protected $fillable = [
        'exam_id',
        'question_id',
        'paragraph_id',
        'order',
    ];

    public function exam()
    {
        return $this->belongsTo(Exam::class);
    }

    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    public function paragraph()
    {
        return $this->belongsTo(Paragraph::class);
    }
}
