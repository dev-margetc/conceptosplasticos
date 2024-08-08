<div>
    <div class="flex gap-4">
        <div class="w-1/2">
            <x-filament::input.wrapper>
                <x-filament::input.select wire:model="projectId" id="project_id" wire:change="getGroups">
                    <option value="">Choose a project</option>
                    @foreach($projects as $project)
                        <option value="{{ $project->id }}">{{ $project->name }}</option>
                    @endforeach
                </x-filament::input.select>
            </x-filament::input.wrapper>
                
        </div>
    
        @if($projectId)
            <div class="w-1/2">
                <x-filament::input.wrapper>
                    <x-slot name="prefix">
                        Total weight
                    </x-slot>
                    <x-filament::input
                        type="text"
                        wire:model="totalWeight"
                        disabled
                    />
                </x-filament::input.wrapper>
            </div>
            
        @endif 
    </div>
    @if($projectId)
    <br>
        <div >
            <x-filament::input.wrapper>
                <x-filament::input.select wire:model="groupId" id="group_id"  wire:change="showTableByGroup">
                    <option value="">Choose a Group</option>
                    @foreach($groups as $group)
                        <option value="{{ $group->id }}">{{ $group->description }}</option>
                    @endforeach
                </x-filament::input.select>
            </x-filament::input.wrapper>
        </div>
    @endif 
    
    <br><br>
    @if($showTable)
        <div class="mt-4">
            {{ $this->table }}
        </div>
    @endif
</div>
