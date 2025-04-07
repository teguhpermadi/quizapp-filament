<?php

namespace App\Livewire;

use App\Enums\ScoreEnum;
use App\Enums\TimerEnum;
use App\Filament\Resources\ExamResource\Pages\ExamQuestion;
use App\Models\Exam;
use App\Models\ExamQuestionParagraph;
use App\Models\Question;
use Filament\Notifications\Notification;
use Livewire\Component;

class ViewQuestion extends Component
{
    public $question;
    public $score;
    public $timer;
    public $questionId;
    public $examId;
    public $visible = true;

    public function mount($question, $exam)
    {
        $this->question = $question;
        $this->score = $question->score;
        $this->timer = $question->timer;
        $this->questionId = $question->id;
        $this->examId = $exam->id;
    }
    
    public function updatedScore($score)
    {
        // Update the score in the database or perform any other necessary action
        $this->question->update(['score' => $score]);
        Notification::make()
            ->title('Score Updated!')
            ->success()
            ->send();
    }

    public function updatedTimer($timer)
    {
        // Update the timer in the database or perform any other necessary action
        $this->question->update(['timer' => $timer]);
        Notification::make()
            ->title('Timer Updated!')
            ->success()
            ->send();
    }

    public function viewExplanation($questionId)
    {
        $this->dispatch('view-explanation', $questionId);
    }

    public function editQuestion($questionId)
    {
        $this->emit('editQuestion', $questionId);
    }

    public function deleteQuestion()
    {
        ExamQuestionParagraph::where('exam_id', $this->examId)
            ->where('question_id', $this->questionId)
            ->delete();

        $this->visible = false;
    }

    public function render()
    {
        return view('livewire.view-question', [
            'scores' => ScoreEnum::cases(),
            'timers' => TimerEnum::cases(),
        ]);
    }
}
