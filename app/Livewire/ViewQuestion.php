<?php

namespace App\Livewire;

use App\Enums\ScoreEnum;
use App\Enums\TimerEnum;
use App\Models\Question;
use Filament\Notifications\Notification;
use Livewire\Component;

class ViewQuestion extends Component
{
    public $question;
    public $score;
    public $timer;

    public function mount($question)
    {
        $this->question = $question;
        $this->score = $question->score;
        $this->timer = $question->timer;
    }

    // app/Livewire/ViewQuestion.php

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

    public function deleteQuestion($questionId)
    {
        $this->emit('deleteQuestion', $questionId);
    }

    public function render()
    {
        return view('livewire.view-question', [
            'scores' => ScoreEnum::cases(),
            'timers' => TimerEnum::cases(),
        ]);
    }
}
