<div>
    <p class="text-sm text-gray-600">Answer choices</p>
    @foreach ($answers as $answer)
        <p><i class="fas fa-check text-green-500 mr-3"></i>{{$answer->answer_text}}</p>
    @endforeach
</div>
