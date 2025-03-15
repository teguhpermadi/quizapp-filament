<?php

namespace App\Livewire;

use Livewire\Component;

class ViewQuestion extends Component
{
    public $question;

    public function mount($question)
    {
        $this->question = $question;
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
        return view('livewire.view-question');
    }
}
