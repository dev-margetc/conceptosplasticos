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
    public $showMixTable = false;
    public $totalProjectWeight;

    protected $listeners = [
        'updateGroupId' => 'updateGroup',
        'componentSelected' => 'showMixTable',
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
                // Tables\Columns\TextColumn::make('missing')->default(0),
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
                        ['componentName' => $record->name, 'projectId' => $this->projectId],
                    ))
                    ->disabled(function ($record) {
                        // dd(ModelComponent::isComponentSelectable($record->name, $this->projectId));
                        return ModelComponent::isComponentSelectable($record->name, $this->projectId);
                    }),
                Action::make('mix')
                    ->label('Mix')
                    ->modalContent(fn (ModelComponent $record): View => view(
                        'filament.pages.production.table-mix-by-component',
                        ['componentName' => $record->name, 'projectId' => $this->projectId],
                    ))
                    ->disabled(function ($record) {
                        return !ModelComponent::isComponentSelectable($record->name, $this->projectId);
                    }),
                
            ])
            ->bulkActions([
                // ...
            ]);
    }
    public function updateGroup($groupId)
    {
        $this->groupId = $groupId;
        $this->resetTable(); 
    }
    public function showMixTable($componentId)
    {
        $this->showMixTable = true;
        // Aquí puedes manejar la lógica adicional si lo necesitas
    }
    public function render()
    {
        return view('livewire.production.step-one.component-by-group-project');
    }
}
