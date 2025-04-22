<div id="question-{{$question->id}}">
    <div class="bg-white border border-gray-300 rounded-lg p-4 w-full"
        x-data="{ open: $wire.entangle('visible') }"
        x-show="open"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 scale-90"
        x-transition:enter-end="opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-300"
        x-transition:leave-start="opacity-100 scale-100"
        x-transition:leave-end="opacity-0 scale-90">
        <div class="flex justify-between items-center">
            <div class="hidden md:flex items-center space-x-2 gap-2">
                <!-- tampilkan tipe soal -->
                <span class="border rounded-md px-2 py-1 text-sm text-gray-600">Type: {{Str::ucwords($question->question_type)}}</span>
                <!-- tampilkan score -->
                <div class="px-2 py-1">
                    <!-- buatkan class dari taildwind yang bagus untuk label dan select score berikut ini -->
                    <label for="score_{{$question->id}}" class="text-gray-600">Score:</label>
                    <select wire:model.live="score" wire:loading.class="opacity-50" wire:loading.attr="disabled" id="score_{{$question->id}}" class="border rounded-md px-2 py-1 text-sm text-gray-600 !bg-none">
                        @foreach ($scores as $scoreEnum)
                        <option value="{{ $scoreEnum->value }}">{{ $scoreEnum->getLabel() }}</option>
                        @endforeach
                    </select>
                </div>
                <!-- tampilkan waktu -->
                <div class="px-2 py-1">
                    <label for="timer_{{$question->id}}" class="text-gray-600">Time:</label>
                    <select wire:model.live="timer" wire:loading.class="opacity-50" wire:loading.attr="disabled" id="timer_{{$question->id}}" class="border rounded-md px-2 py-1 text-sm text-gray-600 !bg-none">
                        @foreach ($timers as $timerEnum)
                        <option value="{{ $timerEnum->value }}">{{ $timerEnum->getLabel() }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="hidden md:flex items-center space-x-2">
                <!-- tampilkan tombol edit -->
                <div class="flex items-center space-x-2">
                    <a href="{{route('filament.admin.resources.exams.question', ['record' => $question->id, 'exam' => $examId])}}" wire:navigate class="border rounded-md px-2 py-1 text-sm">Edit</a>
                </div>
                <!-- tampilkan tombol hapus -->
                <div class="flex items-center space-x-2">
                    <form wire:submit="deleteQuestion">
                        <input type="hidden" wire:model="questionId">
                        <input type="hidden" wire:model="examId">
                        <x-filament::button color="danger" type="submit" size="xs" wire:target="deleteQuestion">
                            Delete
                        </x-filament::button>
                    </form>
                </div>
            </div>
            <div class="md:hidden flex items-center space-x-2 gap-2" x-data="{ showMenu: false }">
                <!-- tombol edit dan delete pada ukuran layar kecil -->
                <button class="bg-gray-300 hover:bg-gray-400 text-gray-600 font-bold py-2 px-4 rounded" @click="showMenu = !showMenu" x-ref="button">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
                <div x-show="showMenu" @click.away="showMenu = false" x-transition x-anchor.offset.2="$refs.button" class="absolute right-0 mt-2 w-24 bg-white rounded-md shadow-md">
                    <button class="block w-full px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900 hover:rounded-t-md">
                        <a href="{{route('filament.admin.resources.exams.question', ['record' => $question->id, 'exam' => $examId])}}">Edit</a>
                    </button>
                    <button wire:click="deleteQuestion" class="block w-full px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900 hover:rounded-b-md">
                        Delete
                    </button>
                </div>
            </div>
        </div>

        <div class="mt-2">
            <p>{{$question->timer}}</p>
            <p class="text-md">{{$question->question}}</p>
        </div>
        <div class="mt-2">
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
        <div class="border-t mt-2"></div>
        <div class="mt-2">
            <p class="text-sm text-gray-600">Explanation</p>
            <!-- <button class="no-underline hover:underline text-sm text-gray-600">More Explanation</button> -->
            @livewire('toggle-text', ['text' => $question->explanation, 'limit'=> 100])
        </div>
        <div class="border-t mt-2"></div>
        <div class="mt-2">
            @livewire('question-tags', ['question' => $question])
        </div>
    </div>
</div>