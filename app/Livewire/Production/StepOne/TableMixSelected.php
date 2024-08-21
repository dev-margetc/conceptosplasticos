<?php

namespace App\Livewire\Production\StepOne;

use Filament\Tables;
use Livewire\Component;
use Filament\Tables\Table;
use App\Models\RawMaterial;
use App\Models\ComponentProject;
use Filament\Tables\Actions\Action;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Contracts\HasTable;
use App\Models\Component as ModelComponent;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Tables\Concerns\InteractsWithTable;

class TableMixSelected extends Component implements HasForms, HasTable
{
    use InteractsWithTable;
    use InteractsWithForms;

    // public $componentId=1;
    public $projectId;
    public $waste = 5;
    public $total = 0;
    public $requeriment;
    public $totalProjectWeight;
    public $missing;
    protected $listeners = ['reloadTableMix' => 'reloadTable'];

    public function table(Table $table): Table
    {
        return $table
            ->query(
                ComponentProject::getComponentMaterials($this->projectId)
            )
            ->columns([
                Tables\Columns\TextColumn::make('component_name')->label('Component Name'),
                Tables\Columns\TextColumn::make('material_name')->label('Material Name'),
                Tables\Columns\TextColumn::make('cost_kg')->label('Cost Kg'),
                Tables\Columns\TextColumn::make('percentage')->label('% Mix'),
                Tables\Columns\TextColumn::make('requeriment')
                    ->getStateUsing(function ($record) {
                        $this->requeriment = $this->totalProjectWeight - ($this->totalProjectWeight *  floatval('0.'.$record->percentage));
                        return $this->requeriment;
                    })
                    ->default(0),
                // Tables\Columns\TextColumn::make('requeriment')->label('Requeriment')->default(''),
                Tables\Columns\TextColumn::make('stock')->label('Stock'),
                Tables\Columns\TextColumn::make('missing')
                    ->getStateUsing(function ($record) {
                        $this->missing = $this->totalProjectWeight - $this->requeriment;
                        return $this->missing;
                    })
                    ->label('Missing'),
                Tables\Columns\TextColumn::make('total')
                    ->getStateUsing(function ($record) {
                        // dd($record);
                        return $this->missing * $record->cost_kg;
                    })
                    ->label('Vr. Total'),
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
        
    }
    public function render()
    {
        return view('livewire.production.step-one.table-mix-selected');
    }
}
