<div class="mt-4 space-y-4">
    <div >
        <label for="project_id">Active Projects</label>
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
                    @livewire('list-groups-and-their-components', ['groupId' => $group->id, 'projectId'=> $this->project_id])
                </x-filament::section>
            @endforeach
        </div>
    @endif
</div>


