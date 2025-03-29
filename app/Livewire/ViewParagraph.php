<?php

namespace App\Livewire;

use App\Models\Paragraph;
use Livewire\Attributes\On;
use Livewire\Component;

class ViewParagraph extends Component
{
    public $paragraph;

    #[On('view-paragraph')]
    public function viewParagraph($paragraph)
    {
        $this->paragraph = Paragraph::find($paragraph);
        $this->dispatch('open-modal', id: 'show-paragraph');
    }

    public function render()
    {
        return view('livewire.view-paragraph');
    }
}
