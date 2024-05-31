<x-filament-panels::page>
    {{-- {{dd($this->listFranchises())}} --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @foreach ($this->listFranchises() as $franchise)
            <div class="bg-white/5 shadow rounded-lg p-4">
                <img src="{{ asset('images/franchises/tigre.png') }}" alt="{{ $franchise->name }}" class="w-full h-48 object-cover rounded-lg mb-4">
                
                <h2 class="text-lg font-semibold">{{ $franchise->company_name }}</h2>
                
                <p class="mt-2">{{ $franchise->description }}</p>
                <div class="mt-4 flex justify-between">
                    {{-- <a href="{{ route('filament.index', $franchise) }}" class="text-blue-600">Ver</a> --}}
                    <a href="/admin/users/{{$franchise->id}}/edit" class="text-blue-600">Editar</a>
                </div>
            </div>
        @endforeach
    </div>
</x-filament-panels::page>
