<div>
    <p class="text-sm text-gray-600">Answer choices</p>
    <!-- buatkan saya tiga kolom -->
    <div class="grid grid-cols-2 gap-2">
        @foreach ($answers as $answer)
        <div class="flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
            </svg>
            <span>{{$answer->answer_text}}</span>
        </div>
        <div class="flex items-center">
            <span class="mr-2">&rarr;</span>
            <span>{{$answer->matchingPair->answer_text}}</span>
        </div>
        @endforeach
    </div>
</div>