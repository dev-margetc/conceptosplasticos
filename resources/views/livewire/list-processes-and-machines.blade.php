<div>
    {{-- {{dd($processes)}} --}}
    @foreach($processes as $process)
        <x-filament::section collapsible class="mb-4">
            <x-slot name="heading">
                {{ $process->name }}
            </x-slot>
            {{-- {{dd($process->id)}} --}}
            @livewire('list-machines', ['processId' => $process->id])
        </x-filament::section>
    @endforeach
</div>
