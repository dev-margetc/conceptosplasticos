<?php

namespace App\Livewire;

use App\Models\Process;
use Livewire\Component;

class ListProcessesAndMachines extends Component
{
   
    public function render()
    {
        return view('livewire.list-processes-and-machines', [
            'processes' => Process::all(),
        ]);
    }

}
