<div>
    @foreach ($answers as $answer)
    @livewire('icon-key-answer', ['is_correct' => $answer->is_correct])
    <p class="font-normal text-md">{{$answer->answer_text}}</p>
    @endforeach
</div>