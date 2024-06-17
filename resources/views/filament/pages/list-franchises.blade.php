<x-filament-panels::page>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @foreach ($this->listFranchises() as $franchise)
            <div class="bg-white/5 shadow rounded-lg p-4">
                <div class="w-full h-72 overflow-hidden rounded-lg mb-4">
                    <img src="{{ asset('storage/' . $franchise->brand_logo) }}" alt="{{ $franchise->name }}"class="w-full h-full object-cover" style="
                    height: 200px">
                </div>
                <h1 class="text-2xl font-semibold text-center">{{ $franchise->company_name }}</h2>
                <br>
                <div class="mt-4 flex justify-center ">
                    <x-filament::button outlined
                        color="primary"
                        href="/admin"
                        tag="a"
                         style="margin-right: 5px"
                    >
                        Ingresar
                    </x-filament::button>
                    {{-- <a href="/admin" class="fi-btn text-center bg-blue-600 text-white py-2 px-4 rounded-lg hover:bg-blue-700">Ingresar</a> --}}
                    @if (auth()->user()->franchise_id == $franchise->id)
                        <x-filament::button outlined
                            color="warning"
                            href="/admin/franchises/{{$franchise->id}}/edit"
                            tag="a"
                             style="margin-left: 5px"
                        >
                            Editar
                        </x-filament::button>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
</x-filament-panels::page>
