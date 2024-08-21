<?php

namespace App\Livewire;

use Filament\Forms;
use Filament\Tables;
use App\Models\Machine;
use Livewire\Component;
use Filament\Tables\Table;
use App\Models\MachineProcess;
use Forms\Components\TextInput;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Contracts\HasTable;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Tables\Concerns\InteractsWithTable;


class ListMachines extends Component implements HasForms, HasTable
{
    use InteractsWithTable;
    use InteractsWithForms;

    public $processId;

    public function table(Table $table): Table
    {
        return $table
            ->query( 
                Machine::query()
                    ->whereHas('process', function ($query) {
                        $query->where('process_id', $this->processId);
                    })
            )
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('machine name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('capacity')
                    ->label('capacity kg/h')
                    ->searchable(),
                Tables\Columns\ToggleColumn::make('status')
                    ->label('status'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\Action::make('addMachine')
                    ->label('Add machine')
                    ->form([
                        Forms\Components\Select::make('machine_id')
                            ->label('Machine')
                            ->options(Machine::all()->pluck('name', 'id')->toArray())
                            ->required()
                    ])
                    ->action(function ( array $data) {
                        MachineProcess::create([
                            'machine_id' => $data['machine_id'],
                            'process_id' => $this->processId,
                        ]);
        
                    })
            ])
            ->actions([
                Tables\Actions\EditAction::make()
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public function render()
    {
        return view('livewire.list-machines');
    }
}
