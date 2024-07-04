<?php

namespace App\Livewire;

use Filament\Tables;
use Livewire\Component;
use Filament\Tables\Table;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Contracts\HasTable;
use App\Models\Component as ModelsComponent;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Tables\Concerns\InteractsWithTable;


class ListGroupsAndTheirComponents extends Component implements HasForms, HasTable
{
    use InteractsWithTable;
    use InteractsWithForms;

    public $groupId;
    public $projectId;

    public function table(Table $table): Table
    {
        return $table
            ->query(
                ModelsComponent::query()
                ->whereHas('project', function ($query) {
                    $query->where('project_id', $this->projectId);
                })
                ->where('group_id', $this->groupId)
            )
            ->headerActions([
                Tables\Actions\CreateAction::make()
                ->form([
                        TextInput::make('components')->numeric()->label('IN')->default(0)->required(),
                    ])
            ])
            ->columns([
                Tables\Columns\TextColumn::make('name')->label('Group')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('quantity')->label('Quantity')->default('')->sortable(),
                Tables\Columns\TextColumn::make('weight')->label('Weight')->default('')->sortable(),
                Tables\Columns\TextColumn::make('total_weight')->label('Total Weight')->default('')->sortable(),
                Tables\Columns\TextColumn::make('kg_price')->label('Kg. Price')->getStateUsing(function ($record) {
                    return $record->kg_price;
                })->sortable(),
            ])
            ->filters([
                // ...
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                // ...
            ]);
    }
    public function render()
    {
        return view('livewire.list-groups-and-their-components');
    }
}
