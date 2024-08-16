<?php

namespace App\Livewire\Production\StepOne;

use Livewire\Component;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Contracts\HasTable;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Actions\Action;
use App\Models\Component as ModelComponent;
use Illuminate\Contracts\View\View;

class ComponentByGroupProject extends Component implements HasForms, HasTable
{
    use InteractsWithTable;
    use InteractsWithForms;

    public $projectId;
    public $groupId;
    protected $listeners = [
        'updateGroupId' => 'updateGroup',
    ];
    public function table(Table $table): Table
    {
        // dd($this->groupId);
        return $table
            ->query(
                ModelComponent::query()
                ->whereHas('project', function ($query) {
                    $query->where('project_id', $this->projectId);
                })
            ->where('group_id', $this->groupId)
        )
            ->columns([
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\TextColumn::make('quantity'),
                Tables\Columns\TextColumn::make('stock')->default(0),
                Tables\Columns\TextColumn::make('missing')->default(0),
            ])
            ->filters([
                // ...
            ])
            ->actions([
                Action::make('select_inventary')
                    ->label('Select inventary')
                    ->button()
                    ->modalContent(fn (ModelComponent $record): View => view(
                        'filament.pages.production.view-mix-components',
                        ['componentName' => $record->name],
                    )
                    
                    
                    ),
                Action::make('mix')
                    ->label('Mix'),
                
                
            ])
            ->bulkActions([
                // ...
            ]);
    }
    public function updateGroup($groupId)
    {
        $this->groupId = $groupId;
        $this->resetTable(); // Forzar la actualización de la tabla
    }
    public function render()
    {
        return view('livewire.production.step-one.component-by-group-project');
    }
}
