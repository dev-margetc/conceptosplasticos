<?php

namespace App\Livewire\Production\StepFive;

use Livewire\Component;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;

class Summary extends Component implements HasForms
{
    use InteractsWithForms;
    
    public $totalProjectWeight;

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('total_components')
                    ->label('Total Components')
                    ->required(),
                TextInput::make('total_materials')
                    ->label('Total Materials')
                    ->numeric()
                    ->required(),
                TextInput::make('total_rrhh')
                    ->label('Total RRHH')
                    ->numeric()
                    ->required(),
                TextInput::make('total_fixed_cost')
                    ->label('Total F. cost')
                    ->numeric()
                    ->required(),
                TextInput::make('total_cost')
                    ->label('Total V. cost')
                    ->numeric()
                    ->required(),
                TextInput::make('total')
                    ->label('Total')
                    ->numeric()
                    ->required(),
            ])
            ->statePath('data');
    }

    public function render()
    {
        return view('livewire.production.step-five.summary');
    }
}
