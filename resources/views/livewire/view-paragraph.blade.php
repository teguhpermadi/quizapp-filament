<div>
<x-filament::modal id="show-paragraph" 
        slide-over 
        :close-by-clicking-away="false" 
        :close-by-escaping="false" 
        width="2xl" 
        sticky-header icon="heroicon-o-document-text"
        icon-color="primary"
    >
    <x-slot name="heading">
        View Paragraph
    </x-slot>

    @if ($paragraph)
        <p>{{ $paragraph->paragraph }}</p>
    @endif
</x-filament::modal>
</div>
