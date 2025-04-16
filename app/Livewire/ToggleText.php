<?php

namespace App\Livewire;

use Livewire\Component;

class ToggleText extends Component
{
    public $fullText;
    public $truncatedText;
    public $text;
    public $isExpanded = false;
    public $show;

    public function mount($text, $limit = 100)
    {
        // set text ke fullText
        $this->fullText = $text;
        // set text ke truncatedText
        $this->truncatedText = substr($text, 0, $limit) . '...';
        
        // jika text lebih dari limit, maka set isExpanded ke false
        if (strlen($text) > $limit) {
            $this->isExpanded = false;
            $this->text = $this->truncatedText;
        } else {
            $this->isExpanded = true;
            $this->text = $this->fullText;
        }

        // set show ke true jika text lebih dari limit
        $this->show = strlen($text) > $limit;
    }

    public function toggleText()
    {
        $this->isExpanded = !$this->isExpanded;
        if ($this->isExpanded) {
            $this->text = $this->fullText;
        } else {
            $this->text = $this->truncatedText;
        }
    }

    public function render()
    {
        return view('livewire.toggle-text');
    }
}
