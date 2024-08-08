<?php

namespace App\Livewire\Production\StepFourt;

use App\Models\Staff;
use Livewire\Component;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Contracts\HasTable;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Table;
use Filament\Tables;

class TableFixedCosts extends Component implements HasForms, HasTable
{
    use InteractsWithTable;
    use InteractsWithForms;

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Staff::query()
            )
            ->columns([
                Tables\Columns\TextColumn::make('item')
                    ->label('Item')
                    ->sortable()
                    ->searchable()
                    ->default(''),
                Tables\Columns\TextColumn::make('valor_unitario')
                    ->label('Valor unitario')
                    ->sortable()
                    ->default(''),
                Tables\Columns\TextColumn::make('participacion')
                    ->label('% participacion')
                    ->sortable()
                    ->default(''),
                Tables\Columns\TextColumn::make('valor_total')
                    ->label('Valor total')
                    ->sortable()
                    ->default(''),
                
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

    public function render()
    {
        return view('livewire.production.step-fourt.table-fixed-costs');
    }
}
