<?php

namespace App\Livewire\Production\StepThree;

use Filament\Tables;
use App\Models\Staff;
use App\Models\Project;
use Livewire\Component;
use Filament\Tables\Table;
use Illuminate\Support\Facades\DB;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Contracts\HasTable;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Tables\Columns\Column;
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
                Tables\Columns\TextInputColumn::make('number_shifts')
                    ->label('Shifts')
                    ->updateStateUsing(function ($record, $state) {
                        // dd($record->id_pivote);
                        $this->updateNumberShifts($record->id_pivote, $state);
                    })
                    ->sortable(),
                Tables\Columns\TextColumn::make('salary')
                    ->label('Salary')
                    ->money('usd')
                    ->sortable(),
                Tables\Columns\TextColumn::make('transport_assistance')
                    ->label('Transport Assistance')
                    ->money('usd')
                    ->sortable(),
                Tables\Columns\TextColumn::make('overtime_surcharge')
                    ->label('Overtime Surcharge')
                    ->money('usd')
                    ->sortable(),
                    Tables\Columns\TextColumn::make('id_pivote')
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
            ->select('staff.*', 'project_staff.number_shifts', 'project_staff.id as id_pivote')
            ->join('project_staff', 'staff.id', '=', 'project_staff.staff_id')
            ->where('project_staff.project_id', $this->projectId);
    }
    public function reloadTable()
    {
        
    }
    public function updateNumberShifts($pivotId, $numberShifts)
    {
        DB::table('project_staff')
        ->where('id', $pivotId)
        ->update(['number_shifts' => $numberShifts]);
        // Obtén el proyecto actual
        // $project = Project::find($this->projectId);

        // // Actualiza el número de turnos en la tabla pivote
        // $project->staff()->updateExistingPivot($staffId, ['number_shifts' => $numberShifts]);
    }

    public function mount(){
        $this->staff = Staff::all();
    }
    public function render()
    {
        return view('livewire.production.step-three.list-project-employees');
    }
}
