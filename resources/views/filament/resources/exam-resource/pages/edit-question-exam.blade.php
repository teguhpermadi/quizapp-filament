<x-filament-panels::page>
    <form wire:submit.prevent="submit">
        {{ $this->form }}

        <x-filament::button type="submit" color="primary" class="mt-4">
            Save
        </x-filament::button>

    </form>
</x-filament-panels::page>