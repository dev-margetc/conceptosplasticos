<?php

namespace App\Livewire\Production\StepFive;

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

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Values')
                // ->columns(2)
                ->schema([
                    TextInput::make('total_components')
                    ->label('Total Components')
                    ->disabled()
                    ->required(),
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
                        ->numeric()
                        ->disabled()
                        ->required(),
                    TextInput::make('total_cost')
                        ->label('Total V. cost')
                        ->numeric()
                        ->disabled()
                        ->required(),
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
