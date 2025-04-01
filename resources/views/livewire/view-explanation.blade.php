<div>
<x-filament::modal id="view-explanation" 
        slide-over 
        :close-by-clicking-away="false" 
        :close-by-escaping="false" 
        width="2xl" 
        sticky-header icon="heroicon-o-document-text"
        icon-color="primary"
    >
    <x-slot name="heading">
        View Explanation
    </x-slot>

    <x-slot name="description">
        <p>{{ ($question) ? $question->question : '' }}</p>
    </x-slot>

    <p>{{ ($question) ? $question->explanation : '' }}</p>
</x-filament::modal>
</div>
