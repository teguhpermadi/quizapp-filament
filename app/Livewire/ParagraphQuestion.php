<?php

namespace App\Livewire;

use App\Models\ExamQuestionParagraph;
use App\Models\Paragraph;
use App\Models\Question;
use Livewire\Component;

class ParagraphQuestion extends Component
{
    public $paragraph, $questions, $exam, $examId, $paragraphId, $visible = true;

    public function mount($paragraph, $questions, $exam)
    {
        $this->paragraph = $paragraph;
        $this->questions = $questions;
        $this->exam = $exam;
        $this->examId = $exam->id;
        $this->paragraphId = $paragraph->id;
    }
    public function render()
    {
        return view('livewire.paragraph-question');
    }

    public function viewParagraph($paragraph)
    {
        $this->dispatch('view-paragraph', $paragraph);
    }

    public function deleteParagraph()
    {
        ExamQuestionParagraph::where('exam_id', $this->examId)
            ->where('paragraph_id', $this->paragraphId)
            ->delete();

        $this->visible = false;
    }
}
