<?php

namespace App\Livewire;

use Livewire\Component;

class ViewShortAnswer extends Component
{
    public $answers;

    public function mount($question)
    {
        $this->answers = $question->answers;
    }
    
    public function render()
    {
        return view('livewire.view-short-answer');
    }
}
