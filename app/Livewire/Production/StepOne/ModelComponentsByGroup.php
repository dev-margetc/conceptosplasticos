<?php

namespace App\Livewire\Production\StepOne;

use Livewire\Component;
use App\Models\Component as ModelComponent;

class ModelComponentsByGroup extends Component
{

    public $componentName;

    public function mount($componentName)
    {
        $this->componentName = $componentName;
    }
    public function getComponentsProperty()
    {
        return ModelComponent::where('name', $this->componentName)
            ->with(['rawMaterial' => function ($query) {
                $query->withPivot('percentage');
            }])
            ->get();
    }
    public function render()
    {
        return view('livewire.production.step-one.model-components-by-group', [
            'components' => $this->components,
        ]);
    }
}
