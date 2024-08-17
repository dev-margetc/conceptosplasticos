<?php

namespace App\Livewire\Production\StepOne;

use Livewire\Component;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Contracts\HasTable;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables;
use Filament\Tables\Table;
use App\Models\Component as ModelComponent;

class ModalMaterialByComponent extends Component implements HasForms, HasTable
{
    use InteractsWithTable;
    use InteractsWithForms;

    public $componentName;
    public $projectId;

    public function mount($componentName, $projectId)
    {
        $this->componentName = $componentName;
        $this->projectId = $projectId;
    }
    public function getComponentMaterialsProperty()
    {
        $selectedComponent = ModelComponent::getSelectedComponent($this->componentName, $this->projectId);
        
        if (!$selectedComponent) {
            return ModelComponent::query()->whereRaw('1 = 0');
        }
        return $selectedComponent->getMaterialsQuery();
        // return ModelComponent::where('id', $this->componentId)
        //     ->with(['rawMaterial' => function ($query) {
        //         $query->withPivot('percentage');
        //     }])
        //     ->first()
        //     ->query();
    }
    public function table(Table $table): Table
    {
        // dd($this->getComponentMaterialsProperty());
        return $table
            ->query(
                $this->getComponentMaterialsProperty()
            )
            ->columns([
                Tables\Columns\TextColumn::make('material_name'),
                Tables\Columns\TextColumn::make('percentage')->label('mix'),
            ])
            ->filters([
                // ...
            ])
            ->actions([
                
            ])
            ->bulkActions([
                // ...
            ]);
    }
    public function render()
    {
        return view('livewire.production.step-one.modal-material-by-component', [
            'component' => $this->componentMaterials,
        ]);
    }
}
