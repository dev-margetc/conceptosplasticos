<?php

namespace App\Livewire\Production\StepThree;

use Livewire\Component;
use App\Models\Staff;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TextInput\Mask;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Illuminate\Contracts\View\View;

class FormStaff extends Component implements HasForms
{
    use InteractsWithForms;

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill();
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('role_name')
                    ->label('Role Name')
                    ->required(),
                TextInput::make('salary')
                    ->label('Salary')
                    ->numeric()
                    ->required(),
                TextInput::make('transport_assistance')
                    ->label('Transport Assistance')
                    ->numeric()
                    ->required(),
                TextInput::make('overtime_surcharge')
                    ->label('Overtime Surcharge')
                    ->numeric()
                    ->required(),
                TextInput::make('epp')
                    ->label('EPP')
                    ->numeric()
                    ->required(),
                TextInput::make('health')
                    ->label('Health')
                    ->numeric()
                    ->required(),
                TextInput::make('pension')
                    ->label('Pension')
                    ->numeric()
                    ->required(),
                TextInput::make('severance_pay')
                    ->label('Severance Pay')
                    ->numeric()
                    ->required(),
            ])
            ->statePath('data');
    }

    public function create(): void
    {
        $validatedData = $this->form->getState();

        Staff::create($validatedData);

        session()->flash('success', 'Staff member added successfully!');

        $this->reset('data');
    }

    public function render()
    {
        // dd('aqui');
        return view('livewire.production.step-three.form-staff');
    }
}
