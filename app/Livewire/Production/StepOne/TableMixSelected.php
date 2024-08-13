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
use App\Models\RawMaterial;
use Illuminate\Contracts\View\View;

class TableMixSelected extends Component implements HasForms, HasTable
{
    use InteractsWithTable;
    use InteractsWithForms;

    public $componentId;

    public function table(Table $table): Table
    {
        return $table
            ->query(
                RawMaterial::whereHas('components', function ($query) {
                    $query->where('id', 1);
                })
            )
            ->columns([
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\TextColumn::make('Cost por'),
                Tables\Columns\TextColumn::make('stock')->default(0),
                Tables\Columns\TextColumn::make('missing')->default(0),
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
        return view('livewire.production.step-one.table-mix-selected');
    }
}
