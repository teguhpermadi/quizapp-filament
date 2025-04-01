<?php

namespace App\Livewire;

use App\Enums\ScoreEnum;
use App\Models\Question;
use Filament\Notifications\Notification;
use Livewire\Component;

class ViewQuestion extends Component
{
    public $question;
    public $score;

    public function mount($question)
    {
        $this->question = $question;
        $this->score = $question->score;
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
        ]);
    }
}
