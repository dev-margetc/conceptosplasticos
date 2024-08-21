<div>
    <h1 class="fi-header-heading text-2xl font-bold tracking-tight text-gray-950 dark:text-white sm:text-3xl">
        Step 1: Mix
    </h1>
    <br>
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
                        wire:model="totalProjectWeight"
                        disabled
                    />
                </x-filament::input.wrapper>
            </div>
            
        @endif 
    </div>
    @if($projectId)
    <br>
        <div>
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
            @livewire('production.step-one.component-by-group-project', ["projectId"=> $projectId, "groupId"=> $groupId, "totalProjectWeight"=> $totalProjectWeight])
        </div>
    @endif
</div>