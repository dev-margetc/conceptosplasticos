<div>
    <form wire:submit.prevent="create">
        {{ $this->form }}

        <button type="submit" class="mt-4 bg-blue-500 text-white p-2 rounded">
            Submit
        </button>
    </form>

    <x-filament-actions::modals />

        <div class="mt-4 bg-green-500 text-white p-2 rounded">
            {{ session('success') }}
        </div>
</div>
