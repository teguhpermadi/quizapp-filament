<div>
    <div class="bg-amber-100 border border-amber-300 rounded-lg p-4 shadow-md w-full"
        x-data="{ open: $wire.entangle('visible') }"
        x-show="open"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 scale-90"
        x-transition:enter-end="opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-300"
        x-transition:leave-start="opacity-100 scale-100"
        x-transition:leave-end="opacity-0 scale-90">
        <div class="flex justify-end items-center space-x-2 gap-2">
            <div class="hidden md:flex items-end space-x-2">
                <!-- tampilkan tombol edit -->
                <div class="flex items-center space-x-2">
                    <button
                        class="border rounded-md bg-white px-2 py-1 text-sm">Edit</button>
                </div>
                <!-- tampilkan tombol hapus -->
                <div class="flex items-center space-x-2">
                    <form wire:submit="deleteParagraph">
                        <input type="hidden" wire:model="paragraphId">
                        <input type="hidden" wire:model="examId">
                        <x-filament::button color="danger" type="submit" size="xs" wire:target="deleteParagraph">
                            Delete
                        </x-filament::button>
                    </form>
                </div>
            </div>
            <div class="md:hidden flex items-end space-x-2" x-data="{ showMenu: false }">
                <!-- tombol edit dan delete pada ukuran layar kecil -->
                <button class="bg-white hover:bg-gray-400 text-gray-600 font-bold py-2 px-4 rounded" @click="showMenu = !showMenu" x-ref="button">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
                <div x-show="showMenu" @click.away="showMenu = false" x-transition x-anchor.offset.2="$refs.button" class="absolute right-0 mt-2 w-24 bg-white rounded-md shadow-md">
                    <button wire:click="editQuestion" class="block w-full px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900 hover:rounded-t-md">
                        Edit
                    </button>
                    <form wire:submit="deleteParagraph">
                        <input type="hidden" wire:model="paragraphId">
                        <input type="hidden" wire:model="examId">
                        <button type="submit" class="block w-full px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900 hover:rounded-b-md">
                            Delete
                        </button>
                    </form>
                </div>
            </div>
        </div>
        <div class="p-2">
            <p>{{ Str::limit($paragraph->paragraph, 300) }}</p>
            <x-filament::button wire:click="viewParagraph('{{ $paragraph->id }}')" class="mt-2" size="xs">
                View More
            </x-filament::button>
        </div>
        @foreach ($questions as $question)
        <div class="my-3">
            @livewire('view-question', ['question' => $question, 'exam' => $exam])
        </div>
        @endforeach
    </div>
</div>