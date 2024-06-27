<?php

namespace App\Livewire;

use App\Models\Group;
use App\Models\Project;
use Livewire\Component;

class ProjectComponents extends Component
{
    public $project_id;
    public $groups = [];
    
    public function getProjectId()
    {
        if ($this->project_id) {
            $this->groups = Group::all();
            // dd($this->groups);
        }

    }
    public function render()
    {
        // dd(Project::where('status', '0')->pluck('name', 'id'));
        return view('livewire.project-components', [
            'projects' => Project::where('status', '0')->pluck('name', 'id'),
            // 'selectedProject'=> $this->selectedProject
        ]);
    }
}
