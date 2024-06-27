<?php

namespace App\Livewire;

use App\Models\ComponentHistory;
use Livewire\Component;
use Filament\Tables\Table;
use Illuminate\Contracts\View\View;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Contracts\HasTable;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Tables\Concerns\InteractsWithTable;

class ViewComponentHistory extends Component implements HasForms, HasTable
{
    use InteractsWithTable;
    use InteractsWithForms;

    public $componentId;

    public function table(Table $table): Table
    {
        // dd($this->componentId);
        return $table
            ->query(
                ComponentHistory::query()
                ->where('component_id', $this->componentId)
            )
            ->columns([
                TextColumn::make('created_at')
                    ->label('Date')
                    ->sortable(),
                TextColumn::make('component.name')
                    ->label('group')
                    ->sortable(),
                TextColumn::make('stock')
                    ->label('stock')
                    ->sortable(),
                TextColumn::make('in')
                    ->label('in')
                    ->sortable(),
                TextColumn::make('out')
                    ->label('out')
                    ->sortable()
                    ->wrap(),
                TextColumn::make('project')
                    ->label('project')
                    ->default('')
            ])
            ->filters([
                // ...
            ])
            ->actions([
                // ...
            ])
            ->bulkActions([
                // ...
            ]);
    }

    public function render()
    {
        return view('livewire.view-client-history');
    }
}
