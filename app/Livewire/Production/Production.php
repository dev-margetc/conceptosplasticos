<?php

namespace App\Livewire\Production;

use App\Models\Project;
use Livewire\Component;

class Production extends Component
{
    public $currentStep = 1;
    public $projectId;
    public $groupId;
    public $totalProjectWeight;

    protected $listeners = [
        'updateProjectId' => 'setProjectId',
        'updateGroupId' => 'setGroupId',
    ];
    public function setProjectId($projectId, $total_weight)
    {
        $this->projectId = $projectId;
        $this->totalProjectWeight = $total_weight;
    }

    public function setGroupId($groupId)
    {
        $this->groupId = $groupId;
    }
    public function nextStep()
    {
        $this->currentStep++;
    }
    public function previousStep()
    {
        $this->currentStep--;
    }
    public function render()
    {
        return view('livewire.production.production');
    }
}
