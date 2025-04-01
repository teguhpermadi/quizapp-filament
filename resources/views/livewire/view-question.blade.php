<div>
    <div class="bg-white border border-gray-300 rounded-lg p-4 w-full">
        <div class="flex justify-between items-center">
            <div class="flex items-center space-x-2 gap-2">
                <!-- tampilkan tipe soal -->
                <span class="border rounded-md px-2 py-1 text-sm text-gray-600">Type: {{Str::ucwords($question->question_type)}}</span>
                <!-- tampilkan score -->
                <div class="px-2 py-1">
                    <!-- buatkan class dari taildwind yang bagus untuk label dan select score berikut ini -->
                    <label for="score" class="text-gray-600">Score:</label>
                    <select wire:model.live="score" wire:loading.class="opacity-50" wire:loading.attr="disabled" id="score_{{$question->id}}" class="border rounded-md px-2 py-1 text-sm text-gray-600 !bg-none">
                        @foreach ($scores as $scoreEnum)
                            <option value="{{ $scoreEnum->value }}">{{ $scoreEnum->getLabel() }}</option>
                        @endforeach
                    </select>
                </div>
                <!-- tampilkan waktu -->
                <div class="px-2 py-1">
                    <label for="time" class="text-gray-600">Time:</label>
                    <select wire:model.live="timer" wire:loading.class="opacity-50" wire:loading.attr="disabled" id="time_{{$question->id}}" class="border rounded-md px-2 py-1 text-sm text-gray-600 !bg-none">
                        @foreach ($timers as $timerEnum)
                            <option value="{{ $timerEnum->value }}">{{ $timerEnum->getLabel() }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="flex items-center space-x-2">
                <!-- tampilkan tombol edit -->
                <div class="flex items-center space-x-2">
                    <button wire:click="editQuestion({{$question->id}})"
                        class="border rounded-md px-2 py-1 text-sm">Edit</button>
                </div>
                <!-- tampilkan tombol hapus -->
                <div class="flex items-center space-x-2">
                    <button wire:click="deleteQuestion({{$question->id}})"
                        class="border rounded-md px-2 py-1 text-sm">Delete</button>
                </div>
            </div>
        </div>

        <div class="mt-6">
            <p class="text-md">{{$question->question}}</p>
        </div>
        <div class="mt-6">
            @switch($question->question_type)
            @case('multiple choice')
            @livewire('multiple-choice-answer', ['question' => $question])
            @break
            @case('multiple answer')
            @livewire('multiple-choice-answer', ['question' => $question])
            @break
            @case('true false')
            @livewire('multiple-choice-answer', ['question' => $question])
            @break
            @case('matching')
            @livewire('matching-answer', ['question' => $question])
            @break
            @case('ordering')
            @livewire('ordering-answer', ['question' => $question])
            @break
            @case('short answer')
            @livewire('short-answer', ['question' => $question])
            @break
            @case('essay')
            @livewire('short-answer', ['question' => $question])
            @break
            @default
            <p>Bukan soal multiple choice</p>
            @endswitch
        </div>
        <!-- buatkan garis pembatas -->
        <div class="border-t mt-6"></div>
        <div class="mt-2">
            <p class="text-sm text-gray-600">Explanation</p>
            <p class="text-sm">{{ Str::limit($question->explanation, 100) }}</p>
            <button class="no-underline hover:underline text-sm text-gray-600" wire:click="viewExplanation('{{ $question->id }}')">More Explanation</button>
        </div>
    </div>
</div>