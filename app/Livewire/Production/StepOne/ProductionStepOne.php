<?php

namespace App\Livewire\Production\StepOne;

use App\Models\Group;
use App\Models\Project;
use Livewire\Component;

class ProductionStepOne extends Component
{
    public $projects = [];
    public $groups = [];
    public $projectId;
    public $groupId;
    public $showTable = false;
    public $totalWeight = 10;

    public function mount()
    {
        $this->projects = Project::all();
    }
    public function getGroups()
    {
        $this->groups = Group::all();
    }
    public function showTableByGroup()
    {
            $this->showTable = $this->projectId &&  $this->groupId;
    }
    public function updatedProjectId()
    {
        $this->getGroups();
        $this->groupId = null;
        $this->showTable = false; // Ocultar la tabla hasta que se seleccione un nuevo grupo
    }
    public function updatedGroupId()
    {
        $this->showTableByGroup();
    }
   
    public function render()
    {
        return view('livewire.production.step-one.production-step-one');
    }
}
