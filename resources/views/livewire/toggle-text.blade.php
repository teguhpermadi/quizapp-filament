<div>
    <p>{{ $text }}</p>
    <button wire:click="toggleText" class="text-blue-500 hover:underline" x-show="$wire.show">
        {{ $isExpanded ? 'Show Less' : 'Show More' }}
    </button>
</div>
