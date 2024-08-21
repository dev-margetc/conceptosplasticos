<?php

namespace App\Livewire\Production\StepThree;

use App\Models\Staff;
use App\Models\Project;
use Livewire\Component;
use Filament\Forms\Form;
use Filament\Forms\Components\Section;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Components\Actions\Action;

class FormSelected extends Component implements HasForms
{
    use InteractsWithForms;

    public ?array $data = [];
    public $projectId;

    protected $listeners = ['refreshStaffList' => '$refresh'];

    public function mount(): void
    {
        // dd(Project::find($this->projectId)->staff->pluck('id', 'role_name')->toArray());
        $this->form->fill([
            'staff' => Project::find($this->projectId)->staff->pluck('id', 'role_name')->toArray(), 
        ]);
    }

    public function form(Form $form): Form
    {
        // dd('aq');
        return $form
            ->schema([
                Section::make('Selected Staff')
                ->schema([
                    CheckboxList::make('staff')
                    ->options(Staff::pluck('role_name', 'id')->toArray())
                    // ->columns(2)
                    ->statePath('data'),
                ])
                ->footerActions([
                    Action::make('submit')
                        ->action(function () {
                           $this->submit();
                        })
                ])
                
            ]);
    }

    public function submit(): void
    {
        $selectedStaff = $this->form->getState()['data'] ?? [];
        if ($project = Project::find($this->projectId)) {
            foreach ($selectedStaff ?? [] as $staffId) {
                // Agrega el staff al proyecto si no existe la relación
                $project->staff()->attach($staffId);
            }
        }
        Notification::make()
            ->title('Staff member added successfully!')
            ->success()
            ->send();

            $this->dispatch('staffAdded');
    }
    public function render()
    {
        return view('livewire.production.step-three.form-selected');
    }
}
