<?php

namespace App\Livewire;

use Filament\Tables;
use App\Models\Group;
use App\Models\Project;
use Livewire\Component;
use Filament\Tables\Table;
use Filament\Tables\Actions\Action;
use Filament\Support\Enums\MaxWidth;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Contracts\HasTable;
use App\Models\Component as ModelComponent;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Tables\Concerns\InteractsWithTable;


class ProductionStepOne extends Component implements HasForms, HasTable
{
    use InteractsWithTable;
    use InteractsWithForms;

    public $projects = [];
    public $groups = [];
    public $projectId;
    public $groupId;
    public $showTable = false;

    public function mount()
    {
        $this->projects = Project::all();
    }
    public function getGroups()
    {
        $this->groups = Group::all();
    }
    public function showTableByGroup()
    {
        if ( $this->projectId &&  $this->groupId) {
            $this->showTable = true;
        }
    }
    public function table(Table $table): Table
    {
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
                    ->button(),
                    // ->modalWidth(MaxWidth::SevenExtraLarge)
                    // ->modalContent(fn ($record) => view('filament.pages.client-resource.view-history')),
                Action::make('mix')
                    ->label('Mix'),
                
                
            ])
            ->bulkActions([
                // ...
            ]);
    }
    public function render()
    {
        return view('livewire.production-step-one');
    }
}
