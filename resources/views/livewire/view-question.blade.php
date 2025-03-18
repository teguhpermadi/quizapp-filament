<div>
    <div class="bg-white border border-gray-100 rounded-lg p-4 shadow-md w-full">
        <div class="flex justify-between items-center">
            <div class="flex items-center space-x-2 gap-2">
                <!-- tampilkan tipe soal -->
                <span class="border rounded-md px-2 py-1 text-sm text-gray-600">Type: {{Str::ucwords($question->question_type)}}</span>
                <!-- tampilkan score -->
                <span class="border rounded-md px-2 py-1 text-sm text-gray-600">Score: {{$question->score}}</span>
                <!-- tampilkan waktu -->
                <span class="border rounded-md px-2 py-1 text-sm text-gray-600">Time: {{$question->timer}} seconds</span>
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
            <p class="text-sm">{{$question->explanation}}</p>
        </div>
    </div>
</div>