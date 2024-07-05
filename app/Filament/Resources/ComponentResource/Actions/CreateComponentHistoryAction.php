<?php

namespace App\Filament\Resources\ComponentResource\Actions;

use Filament\Forms;
use App\Models\Project;
use App\Models\Component;
use App\Models\ComponentHistory;
use App\Models\ComponentProject;
use Filament\Tables\Actions\Action;

class CreateComponentHistoryAction extends Action
{
    protected function setUp(): void
    {
        
        parent::setUp();

        $this->name('register')
            ->label('Register')
            ->button()
            ->accessSelectedRecords()
            ->action(function (Component $record, array $data) {
                // dd($data);
                $in = $data['in'] ?? 0;
                $out = $data['out'] ?? 0;
                $newStock = $in - $out;

                $componentProject = ComponentProject::firstOrCreate([
                    'component_id' => $record->id,
                    'project_id' => $data['project_id'],
                ]);

                // Crear el registro de historial
                ComponentHistory::create([
                    'component_project_id' => $componentProject->id,
                    'stock' => $newStock,
                    'in' => $in,
                    'out' => $out,
                ]);

                session()->flash('notify', 'Component history registered and associated with the project successfully!');
            })
            ->form([
                Forms\Components\TextInput::make('in')->numeric()->label('IN')->default(0)->required(),
                Forms\Components\TextInput::make('out')->numeric()->label('OUT')->default(0)->required(),
                Forms\Components\Select::make('project_id')
                    ->label('Project')
                    ->options(Project::all()->pluck('name', 'id'))
            ]);
    }
}