@vite('resources/css/app.css')
<x-filament-panels::page>
    <x-filament-panels::form>
        {{ $this->form }}
    </x-filament-panels::form>

    @foreach ($questionsGrouped as $questionGrouped => $questions)
        @if ($questionGrouped)
            @livewire('paragraph-question', ['paragraph' => $questionGrouped, 'questions' => $questions])
        @else
            @foreach ($questions as $question)
                @livewire('view-question', ['question' => $question->question])
            @endforeach
        @endif

    @endforeach

    @livewire('view-paragraph')
</x-filament-panels::page>