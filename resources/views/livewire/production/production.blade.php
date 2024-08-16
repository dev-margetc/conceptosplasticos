<div>
    @switch($currentStep)
        @case(1)
            @livewire('production.step-one.production-step-one',['totalProjectWeight' => $totalProjectWeight])
            @break
        @case(2)
            @livewire('list-processes-and-machines', ['isProduction' => true, 'projectId' => $projectId, 'totalProjectWeight' => $totalProjectWeight])
            @break
        @case(3)
            @livewire('production.step-three.list-project-employees', ['projectId' => $projectId])
            @break
        @case(4)
            @livewire('production.step-fourt.table-fixed-costs', ['projectId' => $projectId])
            @break
        @case(5)
            @livewire('production.step-five.summary',  ['projectId' => $projectId, 'totalProjectWeight' => $totalProjectWeight])
            @break
        @default
            @livewire('production.step-one.production-step-one')
    @endswitch
    <br>
    @if (!empty($projectId))
        <x-filament::button wire:click="previousStep">
            previous
        </x-filament::button>
        <x-filament::button wire:click="nextStep">
            Next
        </x-filament::button>
    @endif
    

</div>
