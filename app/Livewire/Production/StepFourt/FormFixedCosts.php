<?php

namespace App\Livewire\Production\StepFourt;

use App\Models\FixedCost;
use App\Models\Project;
use Livewire\Component;
use Filament\Forms\Form;
use Illuminate\Contracts\View\View;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Forms\Concerns\InteractsWithForms;

class FormFixedCosts extends Component implements HasForms
{
    use InteractsWithForms;

    public $projectId;
    public ?array $data = [];
   
    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('item')
                    ->label('Item')
                    ->required(),
                TextInput::make('unit_value')
                    ->label('Unit Value')
                    ->numeric()
                    ->required(),
                TextInput::make('stake')
                    ->label('Stake')
                    ->numeric()
                    ->required(),
                    Select::make('is_fixed')
                    ->label('Type')
                    ->options([
                        0 => 'Fixed',
                        1 => 'Variable',
                    ])
                    ->required(),
                
            ])
            ->statePath('data');
    }
    public function create(): void
    {
        $validatedData = $this->form->getState();
        $validatedData['project_id'] = $this->projectId;
        // dd( $validatedData);
        $staff = FixedCost::create($validatedData);
        Notification::make()
            ->title('Item  added successfully!')
            ->success()
            ->send();
        $this->dispatch('itemAdded');
    }
    

    public function render()
    {
        return view('livewire.production.step-fourt.form-fixed-costs');
    }
}





