<x-filament-panels::page>
    <x-filament-panels::form wire:submit="save">
        {{ $this->form }}

        <x-filament-panels::form.actions
            :actions="$this->getCachedFormActions()"
            :full-width="$this->hasFullWidthFormActions()" />
    </x-filament-panels::form>

    @livewire('exam-question-livewire', ['exam' => $this->record])
    @livewire('view-paragraph')
    @livewire('view-explanation')
</x-filament-panels::page>