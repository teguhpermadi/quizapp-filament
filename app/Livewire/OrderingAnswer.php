<?php

namespace App\Livewire;

use Livewire\Component;

class OrderingAnswer extends Component
{
    public $answers;

    public function mount($question)
    {
        $this->answers = $question->answer()->orderBy('order_position')->get();
    }

    public function render()
    {
        return view('livewire.ordering-answer');
    }
}
