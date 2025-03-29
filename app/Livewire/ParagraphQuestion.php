<?php

namespace App\Livewire;

use App\Models\Paragraph;
use Livewire\Component;

class ParagraphQuestion extends Component
{
    public $paragraph, $questions;

    public function mount($paragraph, $questions)
    {
        $this->paragraph = Paragraph::find($paragraph);
        $this->questions = $questions;
    }
    public function render()
    {
        return view('livewire.paragraph-question');
    }

    public function viewParagraph($paragraph)
    {
        $this->dispatch('view-paragraph', $paragraph);
    }
}
