<x-filament-panels::page>
    @if ($this->hasInfolist())
        {{ $this->infolist }}
    @else
        {{ $this->form }}
    @endif

    @livewire('exam-question-livewire', ['exam' => $this->record])
    @livewire('view-paragraph')
    @livewire('view-explanation')
</x-filament-panels::page>