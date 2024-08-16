<?php

namespace App\Livewire;

use App\Models\Machine;
use App\Models\Process;
use Livewire\Component;

class ListProcessesAndMachines extends Component
{
    public $isProduction = false;
    public $projectId;
    public $totalProjectWeight;
    public $totalHours;

    public function mount()
    {
        $machine = new Machine();
        $this->totalHours = $machine->calculateTotalHours($this->totalProjectWeight);
    }
   
    public function render()
    {
        return view('livewire.list-processes-and-machines', [
            'processes' => Process::all(),
        ]);
    }

}
