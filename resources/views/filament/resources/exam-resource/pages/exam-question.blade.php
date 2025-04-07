@vite('resources/css/app.css')
<x-filament-panels::page>
    <x-filament-panels::form>
        {{ $this->form }}
    </x-filament-panels::form>

    @livewire('exam-question-livewire', ['exam' => $this->record])
    @livewire('view-paragraph')
    @livewire('view-explanation')
</x-filament-panels::page>