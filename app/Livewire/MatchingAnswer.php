<?php

namespace App\Livewire;

use Livewire\Component;

class MatchingAnswer extends Component
{
    public $answers;

    public function mount($question)
    {
        $this->answers = $question->answers()->where('metadata->type', 'domain')->get();
        // dd($this->answers);
    }

    public function render()
    {
        return view('livewire.matching-answer');
    }
}
