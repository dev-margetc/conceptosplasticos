<?php

namespace App\Livewire\Production\StepOne;

use Livewire\Component;
use App\Models\Component as ModelComponent;
use Illuminate\Support\Facades\DB;
use Filament\Notifications\Notification;

class ModelComponentsByGroup extends Component
{

    public $componentName;
    public $projectId;

    public function mount($componentName)
    {
        $this->componentName = $componentName;
    }
    public function getComponentsProperty()
    {
        $projectId = $this->projectId;
        return ModelComponent::whereHas('project', function ($query) use ($projectId) {
            $query->where('project_id', $projectId);
        })
        ->where('name', $this->componentName)
        ->with(['rawMaterial' => function ($query) {
            $query->withPivot('percentage');
        }])
        ->get();
        // return ModelComponent::where('name', $this->componentName)
        //     ->with(['rawMaterial' => function ($query) {
        //         $query->withPivot('percentage');
        //     }])
        //     ->get();
    }
    public function selectComponent($componentId)
    {
        // dd($componentId ? $componentId : "null");
        DB::table('component_project')
            ->where('component_id', $componentId)
            ->where('project_id', $this->projectId)
            ->update(['is_selected' => 1]);
        Notification::make()
            ->title('The component mix was selected successfully!')
            ->success()
            ->send();
        $this->dispatch('componentSelected', $componentId); 
        $this->dispatch('closeModal'); 
        $this->dispatch('reloadTableMix');
    }
    public function render()
    {
        return view('livewire.production.step-one.model-components-by-group', [
            'components' => $this->components,
        ]);
    }
}
