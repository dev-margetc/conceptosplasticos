<?php

namespace App\Livewire\Production;

use Livewire\Component;

class Production extends Component
{
    public $currentStep = 1;
    public $projectId;
    public $groupId;

    protected $listeners = [
        'updateProjectId' => 'setProjectId',
        'updateGroupId' => 'setGroupId',
    ];
    public function setProjectId($projectId)
    {
        $this->projectId = $projectId;
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
