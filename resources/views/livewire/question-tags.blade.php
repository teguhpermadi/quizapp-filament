<div>
    <p class="text-sm text-gray-600">Tags</p>
    <div class="flex flex-wrap gap-2 mt-2">
        @foreach($tags as $tag)
        <span class="px-3 py-1 border-2 border-gray-400 bg-gray-200 text-gray-800 rounded-full text-sm">
            {{ $tag }}
            <button type="button" wire:click="removeTag('{{ $tag }}')" class="ml-2 text-gray-800">×</button>
        </span>
        @endforeach
        <input type="text" wire:model.live="newTag" wire:keydown.enter="addTag" placeholder="Add New Tag" class="border rounded-full px-3 py-1 text-sm">
        @if($results)
            <div class="mt-2 w-full overflow-hidden rounded-md bg-white">
                @foreach ($results as $result)
                <div class="cursor-pointer py-2 px-3 hover:bg-slate-100">
                    <p class="text-sm font-medium text-gray-600" wire:click="setTag('{{$result}}')">{{$result}}</p>
                </div>
                @endforeach
            </div>
        @endif
    </div>
</div>