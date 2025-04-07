<div>
    @foreach ($questionsGrouped as $questionGrouped => $value)
        @if ($value->paragraph)
            <div class="my-3">
                @livewire('paragraph-question', ['paragraph' => $value->paragraph, 'questions' => $value->questions, 'exam' => $exam])
            </div>
        @else
            <div class="my-3">
                @livewire('view-question', ['question' => $value->question, 'exam' => $exam])
            </div>
        @endif
    @endforeach
</div>
