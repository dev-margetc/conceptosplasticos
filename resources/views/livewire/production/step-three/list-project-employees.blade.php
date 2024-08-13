<div class="relative">
    <h1 class="fi-header-heading text-2xl font-bold tracking-tight text-gray-950 dark:text-white sm:text-3xl">
        Step 3: Team
    </h1>
    <div class="flex justify-end mb-4">
        <x-filament::modal width="5xl">
            <x-slot name="trigger">
                <x-filament::button>
                    Add rol
                </x-filament::button>
            </x-slot>
            @livewire('production.step-three.form-staff', ['staffList'=> $staff, 'projectId'=> $projectId])
            {{-- <div class="flex flex-col lg:flex-row space-y-4 lg:space-y-0 lg:space-x-8">
                <!-- Listado de Staff -->
                <div class="w-full lg:w-1/2 p-4 rounded">
                    <h2 class="font-bold mb-2">Added Staff</h2>
                    <ul>
                        @foreach ($staff as $staffItem)
                            <li class="flex items-center space-x-2">
                                <x-filament::input.checkbox 
                                wire:model="selectedStaff" 
                                id="{{$staffItem->id}}"/>
                                <span>     {{ $staffItem->role_name }} </span>
                                <br>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <!-- Formulario -->
                <div class="w-full lg:w-1/2">
                    @livewire('production.step-three.form-staff')
                </div>
            </div> --}}
            {{-- @livewire('production.step-three.form-staff') --}}
        </x-filament::modal>
    </div>
    
    {{$this->table}}
</div>
