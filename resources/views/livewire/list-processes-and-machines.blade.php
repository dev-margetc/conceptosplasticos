<div>
    @if ($isProduction)
        <h1 class="fi-header-heading text-2xl font-bold tracking-tight text-gray-950 dark:text-white sm:text-3xl">
            Step 2: Initial Setup
        </h1>
        <br>
    @endif
    
    @foreach($processes as $process)
        <x-filament::section collapsible class="mb-4">
            <x-slot name="heading">
                {{ $process->name }}
            </x-slot>
            @livewire('list-machines', ['processId' => $process->id])
        </x-filament::section>
    @endforeach

    @if ($isProduction)
        <div class="w-1/2">
            <x-filament::input.wrapper>
                <x-slot name="prefix">
                    total hours
                </x-slot>
                <x-filament::input
                    type="text"
                    wire:model="totalHours"
                    disabled
                />
            </x-filament::input.wrapper>
        </div>
        <br>
    @endif

    


</div>
