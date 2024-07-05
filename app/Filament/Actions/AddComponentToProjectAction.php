<?php



namespace App\Filament\Actions;

use Filament\Forms;
use App\Models\Component;
use App\Models\ComponentHistory;
use App\Models\ComponentProject;
use Filament\Tables\Actions\Action;

class AddComponentToProjectAction extends Action
{
    public static function make($name = 'create'): static
    {
        return parent::make($name)
            ->label('New Component')
            ->form([
                Forms\Components\Select::make('component_id')
                    ->label('Select Component')
                    ->options(function ($livewire) {
                        return Component::where('group_id', $livewire->groupId)
                            ->doesntHave('project', 'and', function ($query) use ($livewire) {
                                $query->where('project_id', $livewire->projectId);
                            })
                            ->pluck('name', 'id');
                    })
                    ->required(),
                Forms\Components\TextInput::make('in')
                    ->label('In')
                    ->numeric()
                    ->required(),
                Forms\Components\TextInput::make('out')
                    ->label('Out')
                    ->numeric()
                    ->required(),
            ])
            ->action(function ($data, $livewire) {
                $component = Component::find($data['component_id']);
                $componentProject = ComponentProject::create([
                    'component_id' => $component->id,
                    'project_id' => $livewire->projectId,
                ]);

                // Calcular el stock
                $in = $data['in'];
                $out = $data['out'];
                $newStock = $in - $out;

                // Crear el registro de historial de componentes
                ComponentHistory::create([
                    'component_project_id' => $componentProject->id,
                    'stock' => $newStock,
                    'in' => $in,
                    'out' => $out,
                ]);
            });
    }
}