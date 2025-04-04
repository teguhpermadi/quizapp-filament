<div>
    <div class="flex flex-wrap gap-2">
        @foreach($tags as $tag)
        <span class="px-3 py-1 border-2 border-gray-400 bg-gray-200 text-gray-800 rounded-full text-sm">
            {{ $tag }}
            <button type="button" wire:click="removeTag('{{ $tag }}')" class="ml-2 text-gray-800">×</button>
        </span>
        @endforeach
        <input type="text" wire:model="newTag" wire:keydown.enter="addTag" placeholder="Add New Tag" class="border rounded-full px-3 py-1 text-sm">
    </div>
</div>