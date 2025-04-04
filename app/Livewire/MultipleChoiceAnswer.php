<?php

namespace App\Livewire;

use Livewire\Component;

class MultipleChoiceAnswer extends Component
{
    public $answers;

    public function mount($question)
    {
        $this->answers = $question->answers;
    }
    public function render()
    {
        return view('livewire.multiple-choice-answer');
    }
}
