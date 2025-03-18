<?php

namespace App\Livewire;

use Livewire\Component;

class ShortAnswer extends Component
{
    public $answers;

    public function mount($question)
    {
        $this->answers = $question->answers;
    }
    
    public function render()
    {
        return view('livewire.short-answer');
    }
}
