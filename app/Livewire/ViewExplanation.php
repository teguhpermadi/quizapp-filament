<?php

namespace App\Livewire;

use App\Models\Question;
use Livewire\Attributes\On;
use Livewire\Component;

class ViewExplanation extends Component
{
    public $question;

    #[On('view-explanation')]
    public function viewExplanation($questionId)
    {
        $this->question = Question::find($questionId);
        $this->dispatch('open-modal', id: 'view-explanation');
    }
    
    public function render()
    {
        return view('livewire.view-explanation');
    }
}
