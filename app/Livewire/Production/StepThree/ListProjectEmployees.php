<?php

namespace App\Livewire\Production\StepThree;

use Filament\Tables;
use App\Models\Staff;
use Livewire\Component;
use Filament\Tables\Table;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Contracts\HasTable;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Tables\Concerns\InteractsWithTable;

class ListProjectEmployees extends Component implements HasForms, HasTable
{
    use InteractsWithTable;
    use InteractsWithForms;

    public $staff;
    public array $selectedStaff = [];
    public $projectId;

    protected $listeners = ['staffAdded' => 'reloadTable'];

    public function table(Table $table): Table
    {
        return $table
            ->query(
                $this->getProjectStaffQuery()
            )
            ->columns([
                Tables\Columns\TextColumn::make('role_name')
                    ->label('Role Name')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('salary')
                    ->label('Salary')
                    ->money('usd')
                    ->sortable(),
                Tables\Columns\TextInputColumn::make('number_shifts')
                    ->label('Shifts')
                    ->sortable(),
                Tables\Columns\TextColumn::make('transport_assistance')
                    ->label('Transport Assistance')
                    ->money('usd')
                    ->sortable(),
                Tables\Columns\TextColumn::make('overtime_surcharge')
                    ->label('Overtime Surcharge')
                    ->money('usd')
                    ->sortable(),
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

    protected function getProjectStaffQuery()
    {
        return Staff::query()
            ->select('staff.*', 'project_staff.number_shifts')
            ->join('project_staff', 'staff.id', '=', 'project_staff.staff_id')
            ->where('project_staff.project_id', 1);
    }
    public function reloadTable()
    {
        // Puedes agregar lógica adicional si es necesario
    }
    public function mount(){
        $this->staff = Staff::all();
    }
    public function render()
    {
        return view('livewire.production.step-three.list-project-employees');
    }
}
