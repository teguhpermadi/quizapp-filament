<x-filament-panels::page>
    <x-filament-panels::form>
        {{ $this->form }}
    </x-filament-panels::form>

    @foreach ($questions as $question)
        @livewire('view-question', ['question' => $question])
    @endforeach
</x-filament-panels::page>