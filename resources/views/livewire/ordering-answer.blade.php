<div>
    <p class="text-sm text-gray-600">Answer choices</p>
    <ol class="list-decimal list-inside">
        @foreach ($answers as $answer)
            <li>{{$answer->answer_text}}</li>
        @endforeach
    </ol>
</div>