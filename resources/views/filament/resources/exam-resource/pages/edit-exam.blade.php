<x-filament-panels::page>
    <x-filament-panels::form wire:submit="save">
        {{ $this->form }}

        <x-filament-panels::form.actions
            :actions="$this->getCachedFormActions()"
            :full-width="$this->hasFullWidthFormActions()" />
    </x-filament-panels::form>

    @livewire('exam-question-livewire', ['exam' => $this->record])
    @livewire('view-paragraph')
    <script>
        window.addEventListener('livewire:navigated', () => {
            setTimeout(() => {
                if (window.location.hash == "") {
                    window.scrollTo({
                        top: 0
                    });
                } else {
                    const element = document.querySelector(window.location.hash)
                    element.scrollIntoView({
                        behavior: 'smooth'
                    })
                }
            }, 1)
        })
    </script>
</x-filament-panels::page>