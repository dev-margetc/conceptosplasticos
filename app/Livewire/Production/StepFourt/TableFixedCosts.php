<?php

namespace App\Livewire\Production\StepFourt;

use Filament\Tables;
use Livewire\Component;
use App\Models\FixedCost;
use Filament\Tables\Table;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Contracts\HasTable;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Tables\Concerns\InteractsWithTable;

class TableFixedCosts extends Component implements HasForms, HasTable
{
    use InteractsWithTable;
    use InteractsWithForms;

    public $totalValue;
    public $projectId;
    public $totalFixedCosts;
    public $totalVariableCosts;

    protected $listeners = ['itemAdded' => 'reloadTable'];

    public function mount()
    {
        $this->calculateTotal();
    }

    public function calculateTotal()
    {
        $this->totalFixedCosts = FixedCost::calculateFixedCosts($this->projectId);
        $this->totalVariableCosts = FixedCost::calculateVariableCosts($this->projectId);
        $this->totalValue = FixedCost::calculateTotalCosts($this->projectId);
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(
                FixedCost::where('project_id', $this->projectId)
            )
            ->columns([
                Tables\Columns\TextColumn::make('item')
                    ->label('Item')
                    ->sortable()
                    ->searchable()
                    ->default(''),
                Tables\Columns\TextInputColumn::make('unit_value')
                    ->label('Valor unitario')
                    ->sortable()
                    ->afterStateUpdated(function ($record, $state) {
                        $this->calculateTotal();
                    })
                    ->default(''),
                Tables\Columns\TextInputColumn::make('stake')
                    ->label('% participacion')
                    ->sortable()
                    ->afterStateUpdated(function ($record, $state) {
                        $this->calculateTotal();
                    })
                    ->default(''),
                Tables\Columns\TextColumn::make('total_value')
                    ->label('Valor total')
                    ->getStateUsing(fn($record) => $record->unit_value * ($record->stake/100))
                    ->formatStateUsing(fn($state) => '$' . number_format($state, 2))
                    ->sortable(),
                
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
    public function reloadTable()
    {
        $this->calculateTotal();
    }

    public function render()
    {
        return view('livewire.production.step-fourt.table-fixed-costs');
    }
}
