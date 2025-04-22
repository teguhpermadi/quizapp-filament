<div>
    <p class="text-sm text-gray-600">Answer choices</p>
    @foreach ($answers as $answer)
    <div class="mt-2 grid grid-cols-2 gap-2">
        <div class="flex items-center space-x-2">
            @livewire('icon-key-answer', ['is_correct' => $answer->is_correct])
            <span class="font-normal text-md">{{$answer->answer_text}}</span>
        </div>
    </div>
    @endforeach
</div>