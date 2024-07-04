<?php

namespace App\Filament\Resources\ComponentResource\Actions;

use App\Models\Component;
use App\Models\ComponentHistory;
use Filament\Forms;
use Filament\Tables\Actions\Action;

class CreateComponentHistoryAction extends Action
{
    
    protected function setUp(): void
    {
        
        parent::setUp();

        $this->name('register')
            ->label('Register')
            ->button()
            ->accessSelectedRecords()
            ->action(function (Component $record, array $data) {
                dd($record);
                $in = $data['in'] ?? 0;
                $out = $data['out'] ?? 0;
                $newStock = $in - $out;

                ComponentHistory::create([
                    'component_id' => $record->id,
                    'stock' => $newStock,
                    'in' => $in,
                    'out' => $out,
                ]);
            });
            // ->form([
            //     Forms\Components\TextInput::make('in')->numeric()->label('IN')->default(0)->required(),
            //     Forms\Components\TextInput::make('out')->numeric()->label('OUT')->default(0)->required(),
            // ]);
    }
}