<div>
        
        <!-- Formulario -->
        <div >
            <h2 class="font-bold mb-2">Added Item</h2>
            <form wire:submit.prevent="create">
                {{ $this->form }}
        
                {{-- <button type="submit" class="mt-4 bg-blue-500 text-white p-2 rounded">
                    Submit
                </button> --}}
                <br>
                <x-filament::button wire:click="create">
                    Submit
                </x-filament::button>
            </form>
        
            <x-filament-actions::modals />
        
        </div>
</div>
