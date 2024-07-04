<?php

namespace App\Livewire;

use Filament\Tables;
use Livewire\Component;
use Filament\Tables\Table;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Contracts\HasTable;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\SelectColumn;
use App\Models\Component as ModelComponent;
use Filament\Tables\Columns\TextInputColumn;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Tables\Concerns\InteractsWithTable;


class ExcessMaterialTable extends Component implements HasForms, HasTable
{
    use InteractsWithTable;
    use InteractsWithForms;

    public $groupId;
    public $projectId;
    
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
            ->headerActions([
                Tables\Actions\CreateAction::make()
                ->form([
                        TextInput::make('components')->numeric()->label('IN')->default(0)->required(),
                    ])
            ])
            ->columns([
                TextColumn::make('name')->label('Group')->sortable()->searchable(),
                SelectColumn::make('wall')
                    ->label('Wall')
                    ->options([
                        'Muro 1' => 'Muro 1',
                        'Muro 2' => 'Muro 2',
                        'Muro 3' => 'Muro 3',
                    ])
                    ->default('Muro 1')
                    ->sortable(),
                TextColumn::make('ubication')->label('Ubication')->default(''),
                TextColumn::make('large')->label('Large')->default(''),
                TextInputColumn::make('quantity')->label('Quantity')->default(''),
                TextInputColumn::make('weight')->label('Weight')->default(''),
                TextColumn::make('real_weight')->label('Real Weight')->default(''),
                TextColumn::make('waste')->label('Waste')->default(''),
                TextColumn::make('total_weight')->label('Total Weight')->default(''),
                TextColumn::make('kg_price')->label('Kg. Price')->getStateUsing(function ($record) {
                    return $record->kg_price;
                })->sortable(),
                TextColumn::make('total_cost')->label('Total Cost')->default(''),
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
        return view('livewire.excess-material-table');
    }
}
