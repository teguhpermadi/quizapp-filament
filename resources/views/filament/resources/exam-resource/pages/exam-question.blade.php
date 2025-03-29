@vite('resources/css/app.css')
<x-filament-panels::page>
    <x-filament-panels::form>
        {{ $this->form }}
    </x-filament-panels::form>

    @foreach ($questionsGrouped as $questionGrouped => $value)
        @if ($value->paragraph)
            @livewire('paragraph-question', ['paragraph' => $value->paragraph, 'questions' => $value->questions])
        @else
            @livewire('view-question', ['question' => $value->question])
        @endif
    @endforeach

    @livewire('view-paragraph')
</x-filament-panels::page>