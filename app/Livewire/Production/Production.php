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
    public $totalComponents;
    public $totalMaterials;

    protected $listeners = [
        'updateProjectId' => 'setProjectId',
        'updateGroupId' => 'setGroupId',
        'updateTotalComponents' => 'setTotalComponents',
        'updateTotalMaterials' => 'setTotalMaterials',
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
    public function setTotalComponents($totalComponents)
    {
        $this->totalComponents = $totalComponents;
    }
    public function setTotalMaterials($totalMaterials)
    {
        $this->totalMaterials = $totalMaterials;
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
