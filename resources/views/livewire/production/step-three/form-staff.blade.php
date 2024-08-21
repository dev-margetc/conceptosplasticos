{{-- <div>
    <form wire:submit.prevent="create">
        {{$this->formSelectedStaff}}
        {{ $this->form }} --}}

        {{-- <button type="submit" class="mt-4 bg-blue-500 text-white p-2 rounded">
            Submit
        </button> --}}
        {{-- <br>
        <x-filament::button wire:click="create">
            Submit
        </x-filament::button>
    </form>

    <x-filament-actions::modals />

        <div class="mt-4 bg-green-500 text-white p-2 rounded">
            {{ session('success') }}
        </div>
</div> --}}

<div class="flex flex-col lg:flex-row space-y-4 lg:space-y-0 lg:space-x-8">
    <!-- Listado de Staff -->
    <div class="w-full lg:w-1/2 p-4 rounded">
        {{-- <h2 class="font-bold mb-2">Selected Staff</h2> --}}
        @livewire('production.step-three.form-selected', ['projectId'=> $projectId])
        {{-- <form wire:submit.prevent="saveSelectedStaff">
            {{ $this->formSelectedStaff }}
     --}}
            {{-- <button type="submit" class="mt-4 bg-blue-500 text-white p-2 rounded">
                Submit
            </button> --}}
            {{-- <br>
            <x-filament::button type="submit">
                Submit
            </x-filament::button>
        </form>
    
        <x-filament-actions::modals /> --}}
        
    </div>
    <!-- Formulario -->
    <div class="w-full lg:w-1/2">
        <h2 class="font-bold mb-2">Added Staff</h2>
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
    
        <div class="mt-4 bg-green-500 text-white p-2 rounded">
            {{ session('success') }}
        </div>
    </div>
</div>
