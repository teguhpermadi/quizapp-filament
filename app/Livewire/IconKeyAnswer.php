<?php

namespace App\Livewire;

use Livewire\Component;

class IconKeyAnswer extends Component
{
    public $is_correct;

    public function mount($is_correct)
    {
        $this->is_correct = $is_correct;
    }
    
    public function render()
    {
        return view('livewire.icon-key-answer');
    }
}
