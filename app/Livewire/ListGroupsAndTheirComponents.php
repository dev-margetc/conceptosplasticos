<?php

namespace App\Livewire;

use Filament\Tables;
use Livewire\Component;
use Filament\Tables\Table;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Contracts\HasTable;
use App\Models\Component as ModelsComponent;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Tables\Concerns\InteractsWithTable;
use App\Filament\Actions\AddComponentToProjectAction;


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
                AddComponentToProjectAction::make()
            ])
            ->columns([
                Tables\Columns\TextColumn::make('name')->label('Group')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('quantity')->label('Quantity'),
                Tables\Columns\TextColumn::make('weight')->label('Weight'),
                Tables\Columns\TextColumn::make('total_weight')->label('Total Weight')->getStateUsing(function ($record) {
                    // dd( $record->Weight );
                    return $record->weight * $record->quantity;
                }),
                Tables\Columns\TextColumn::make('kg_price')->label('Kg. Price')->getStateUsing(function ($record) {
                    return $record->kg_price;
                })->sortable(),
                Tables\Columns\TextColumn::make('total_cost')->label('Total Cost')->getStateUsing(function ($record) {
                    // dd($record);
                    return $record->total_cost;
                })->sortable(),
            ])
            ->filters([
                // ...
            ])
            ->actions([
                // Tables\Actions\EditAction::make(),
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
