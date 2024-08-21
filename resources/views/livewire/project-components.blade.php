<div class="mt-4 space-y-4">
    <div >
        {{-- <label for="project_id">Active Projects</label> --}}
        <x-filament::input.wrapper>
            <x-filament::input.select wire:model="project_id" wire:change="getProjectId">
                <option value="">Select a project</option>
                @foreach($projects as $id => $name)
                    <option value="{{ $id }}">{{ $name }}</option>
                @endforeach
            </x-filament::input.select>
        </x-filament::input.wrapper>
    </div>
    @error('project_id') <span class="error">{{ $message }}</span> @enderror

    @if ($groups)
        <div class="mt-4 space-y-4">
            @foreach($groups as $group)
                <x-filament::section collapsible class="mb-4">
                    <x-slot name="heading">
                        {{ $group->description }}
                    </x-slot>
                    <!-- Aquí se mostrarán los componentes del grupo -->
                    <p>Componentes para {{ $group->description }}</p>
                    <br>
                    @if ($group->id == 2)
                        @livewire('excess-material-table', ['groupId' => $group->id, 'projectId'=> $this->project_id])
                    @else
                        @livewire('list-groups-and-their-components', ['groupId' => $group->id, 'projectId'=> $this->project_id])
                    @endif
                </x-filament::section>
            @endforeach
        </div>
        <br>
        <div class="flex items-center w-1/2 space-x-4">
            <x-filament::input.wrapper class="flex-1">
                <x-slot name="prefix">
                    Units
                </x-slot>
                <x-filament::input
                    type="text"
                    wire:model="units"
                />
            </x-filament::input.wrapper>
            <x-filament::button wire:click="sendUnitsproject" class="ml-4">
                Submit
            </x-filament::button>
        </div>
    @endif
</div>


