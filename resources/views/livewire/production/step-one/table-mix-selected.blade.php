<div>
    {{$this->table}}
    <br>
    <div class="w-1/2">
        <x-filament::input.wrapper>
            <x-slot name="prefix">
                Waste %
            </x-slot>
            <x-filament::input
                wire:change="updateWaste"
                type="text"
                wire:model="waste"
            />
        </x-filament::input.wrapper>
    </div>
    <br>
    <div class="w-1/2">
        <x-filament::input.wrapper>
            <x-slot name="prefix">
               Total
            </x-slot>
            <x-filament::input
                type="text"
                wire:model="total"
                disabled
            />
        </x-filament::input.wrapper>
    </div>
    <br>
    <x-filament::button 
        wire:click="downloadPdf"
        color="info">
        pdf
    </x-filament::button>
</div>
