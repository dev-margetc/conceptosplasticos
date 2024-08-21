<?php

namespace App\Livewire\Production\StepFive;

use App\Models\FixedCost;
use Livewire\Component;
use Filament\Forms\Form;
use Filament\Forms\Components\Section;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;

class Summary extends Component implements HasForms
{
    use InteractsWithForms;

    public $totalProjectWeight;
    public $projectId;
    public $data;
    public $totalComponents;
    public $totalMaterials;
    public $totalRrhh;
    public $totalFixedCosts;
    public $totalVariableCosts;
    public $totalCosts;
    
    public function mount()
    {
        $this->totalRrhh = 1;
        $this->totalFixedCosts = FixedCost::calculateFixedCosts($this->projectId);
        $this->totalVariableCosts = FixedCost::calculateVariableCosts($this->projectId);
        $this->totalCosts = $this->totalComponents + $this->totalMaterials +  $this->totalRrhh + $this->totalFixedCosts + $this->totalVariableCosts;
        $this->data = [
            'total_components'=> $this->totalComponents,
            'total_materials'=> $this->totalMaterials,
            'total_rrhh'=> $this->totalRrhh,
            'total_fixed_cost'=> $this->totalFixedCosts,
            'total_variable_cost'=> $this->totalVariableCosts,
            'total'=> $this->totalCosts,
        ];
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Values')
                // ->columns(2)
                ->schema([
                    TextInput::make('total_components')
                    ->label('Total Components')
                    ->disabled(),
                    TextInput::make('total_materials')
                        ->label('Total Materials')
                        ->numeric()
                        ->disabled()
                        ->required(),
                    TextInput::make('total_rrhh')
                        ->label('Total RRHH')
                        ->numeric()
                        ->disabled()
                        ->required(),
                    TextInput::make('total_fixed_cost')
                        ->label('Total F. cost')
                        // ->numeric()
                        ->disabled(),
                    TextInput::make('total_variable_cost')
                        ->label('Total V. cost')
                        // ->numeric()
                        ->disabled(),
                    TextInput::make('total')
                        ->label('Total')
                        ->numeric()
                        ->disabled()
                        ->required(),
                ])

            ])
            ->statePath('data');
    }

    public function render()
    {
        return view('livewire.production.step-five.summary');
    }
}
