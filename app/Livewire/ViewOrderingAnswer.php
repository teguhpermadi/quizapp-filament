<?php

namespace App\Livewire;

use Livewire\Component;

class ViewOrderingAnswer extends Component
{
    public $answers;

    public function mount($question)
    {
        $this->answers = $question->answers()->orderBy('order_position')->get();
    }

    public function render()
    {
        return view('livewire.view-ordering-answer');
    }
}
