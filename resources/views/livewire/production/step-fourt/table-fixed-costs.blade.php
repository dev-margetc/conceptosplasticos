<div>
    {{$this->table}}
    <br>
    <div class="w-1/2">
        <x-filament::input.wrapper>
            <x-slot name="prefix">
                Valor total
            </x-slot>
            <x-filament::input
                type="text"
                wire:model="total"
                disabled
            />
        </x-filament::input.wrapper>
    </div>
</div>
