<div>
    
    @foreach ($components as $component)
        <div class="p-4 border-b">
            <h4>{{ $component->name }} </h4> 
            @foreach ($component->rawMaterial as $material)
                <p>{{ $material->name }}: {{ $material->pivot->percentage }}%</p>
            @endforeach
            {{-- {{$component->id}} --}}
            {{-- <x-filament::button wire:click="selectComponent({{ $component->id }})">
                Select
            </x-filament::button> --}}
            <button wire:click="selectComponent({{ $component->id }})" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded">
                Select
            </button>
        </div>
    @endforeach
</div>
{{-- OTRA OPCION PARA ACOMODAR EL MIX --}}
{{-- <div class="flex flex-wrap -mx-2">
    @foreach ($components as $component)
        <div class="p-4 border-b flex-grow max-w-xs mx-2  shadow rounded">
            <h4 class="font-bold">{{ $component->name }}</h4>
            <div>
                @foreach ($component->rawMaterial as $material)
                    <p>{{ $material->name }}: {{ $material->pivot->percentage }}%</p>
                @endforeach
            </div>
            <x-filament::button >
                Select
            </x-filament::button>
        </div>
    @endforeach
</div> --}}