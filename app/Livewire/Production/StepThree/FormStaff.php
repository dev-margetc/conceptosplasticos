<?php

namespace App\Livewire\Production\StepThree;

use App\Models\Staff;
use App\Models\Project;
use Livewire\Component;
use Filament\Forms\Form;
use Illuminate\Contracts\View\View;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Forms\Concerns\InteractsWithForms;

class FormStaff extends Component implements HasForms
{
    use InteractsWithForms;

    public ?array $data = [];
    public ?array $selectedStaff = [];
    public $projectId;
    public $staffList = [];

    public function mount(): void
    {
        $this->form->fill();
        $this->loadStaffList();
    }
    protected function getForms(): array
    {
        return [
            'formSelectedStaff',
            'form'
        ];
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
        $staff = Staff::create($validatedData);
        // $this->formSelectedStaff->fill();
        Notification::make()
            ->title('Staff member added successfully!')
            ->success()
            ->send();
        $this->loadStaffList();
            // $this->formSelectedStaff->fill();
        $this->reset('data');
        $this->selectedStaff['employeed_' . $staff->id] = true;
    }
    public function formSelectedStaff(Form $form): Form
    {
        return $form
            ->schema($this->getStaffCheckBox())
            ->statePath('selectedStaff');
    }
    private function loadStaffList()
    {
        $this->staffList = Staff::all();
    }
    private function getStaffCheckBox(): array
    {
        // $staff = Staff::all();
        $materialSchemas = [];

        foreach ($this->staffList as $employeed) {
            $materialSchemas[] = Checkbox::make('employeed_' . $employeed->id)
                ->label($employeed->role_name);
        }

        return $materialSchemas;
    }
    public function saveSelectedStaff()
    {
        // dd($this->projectId);
        $project = Project::find($this->projectId);

        if (!$project) {
            session()->flash('error', 'Project not found!');
            return;
        }

        $selectedIds = array_keys(array_filter($this->selectedStaff));

        foreach ($selectedIds as $staffKey) {
            $staffId = str_replace('employeed_', '', $staffKey);
            $project->staff()->attach($staffId);
        }
        Notification::make()
            ->title('Staff member added successfully!')
            ->success()
            ->send();

            $this->dispatch('staffAdded');
    }

    public function render()
    {
        return view('livewire.production.step-three.form-staff');
    }
}
