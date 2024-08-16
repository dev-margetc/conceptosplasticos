<div>
    {{$this->table}}
    <br>
    @if ($showMixTable)
        <div class="mt-4">
            <h3>Table Mix</h3>
            <br>
            @livewire('production.step-one.table-mix-selected')
        </div>
    @endif
</div>
