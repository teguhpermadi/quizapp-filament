<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Paragraph extends Model
{
    /** @use HasFactory<\Database\Factories\ParagraphFactory> */
    use HasFactory;
    use HasUlids;
    use SoftDeletes;

    protected $fillable = [
        'paragraph',
    ];

    public function questions()
    {
        return $this->belongsToMany(Question::class, 'exam_question_paragraph')
            ->withPivot('exam_id');
    }

    public function exams()
    {
        return $this->belongsToMany(Exam::class, 'exam_question_paragraph')
            ->withPivot('question_id');
    }

    public function examquestionparagraphs()
    {
        return $this->hasMany(ExamQuestionParagraph::class);
    }
}
