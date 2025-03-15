<div>
    <div class="bg-white border border-gray-100 rounded-lg p-4 shadow-md w-full">
        <div class="flex justify-between items-center">
            <div class="flex items-center space-x-2">
                <!-- tampilkan tipe soal -->
                <div class="flex items-center space-x-2">
                    <span class="text-sm font-light text-gray-600">Type: {{$question->question_type}}</span>
                </div>
                <!-- tampilkan score -->
                <div class="flex items-center space-x-2">
                    <span class="text-sm font-light text-gray-600">Score: {{$question->score}}</span>
                </div>
                <!-- tampilkan waktu -->
                <div class="flex items-center space-x-2">
                    <span class="text-sm font-light text-gray-600">Time: {{$question->timer}} seconds</span>
                </div>
            </div>
            <div class="flex items-center space-x-2">
                <!-- tampilkan tombol edit -->
                <div class="flex items-center space-x-2">
                    <button wire:click="editQuestion({{$question->id}})" class="text-sm font-light text-gray-600 hover:text-blue-500">Edit</button>
                </div>
                <!-- tampilkan tombol hapus -->
                <div class="flex items-center space-x-2">
                    <button wire:click="deleteQuestion({{$question->id}})" class="text-sm font-light text-gray-600 hover:text-red-500">Delete</button>
                </div>
            </div>
        </div>

        <div class="mt-6">
            <p class="font-normal text-md">{{$question->question}}</p>
        </div>
        <div class="mt-6">
            @switch($question->question_type)
                @case('multiple choice')
                    @livewire('multiple-choice-answer', ['question' => $question])
                    @break
                @case('multiple answer')
                    @livewire('multiple-choice-answer', ['question' => $question])
                    @break
                @default
                <p>Bukan soal multiple choice</p>
            @endswitch
        </div>
    </div>
</div>