<div>
    <div class="bg-amber-100 border border-amber-300 rounded-lg p-4 shadow-md w-full">
        <div class="p-2">
            <p>{{ Str::limit($paragraph->paragraph, 300) }}</p>
        </div>
        @foreach ($questions as $question)
        <div class="my-3">
            @livewire('view-question', ['question' => $question->question])
        </div>
        @endforeach
    </div>
</div>