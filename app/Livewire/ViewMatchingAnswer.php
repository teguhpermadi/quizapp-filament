<?php

namespace App\Livewire;

use Livewire\Component;

class ViewMatchingAnswer extends Component
{
    public $answers;

    public function mount($question)
    {
        $this->answers = $question->answers()->where('metadata->type', 'domain')->get();
        // dd($this->answers);
    }

    public function render()
    {
        return view('livewire.view-matching-answer');
    }
}
