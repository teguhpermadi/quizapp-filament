<?php

namespace App\Livewire;

use Livewire\Component;

class ShortAnswer extends Component
{
    public $answer;

    public function mount($question)
    {
        $this->answer = $question->answer;
    }
    
    public function render()
    {
        return view('livewire.short-answer');
    }
}
