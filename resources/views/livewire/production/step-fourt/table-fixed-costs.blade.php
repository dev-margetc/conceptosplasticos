<div>
    <h1 class="fi-header-heading text-2xl font-bold tracking-tight text-gray-950 dark:text-white sm:text-3xl">
        Step 4-5: Mix Fixed And Variable costs
    </h1>
    <div class="flex justify-end mb-4">
        <x-filament::modal width="5xl">
            <x-slot name="trigger">
                <x-filament::button>
                    Add Item
                </x-filament::button>
            </x-slot>
            @livewire('production.step-fourt.form-fixed-costs', ['projectId'=> $projectId])
            
        </x-filament::modal>
    </div>
    <br>
    {{$this->table}}
    <br>
    <div class="w-1/2">
        <x-filament::input.wrapper>
            <x-slot name="prefix">
                Valor total
            </x-slot>
            <x-filament::input
                type="text"
                wire:model="totalValue"
                disabled
            />
        </x-filament::input.wrapper>
    </div>
</div>
