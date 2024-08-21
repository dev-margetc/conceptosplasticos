<?php

namespace App\Filament\Resources\MachineResource\Pages;

use App\Filament\Resources\MachineResource;
use App\Models\Process;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Forms;

class ListMachines extends ListRecords
{
    protected static string $resource = MachineResource::class;
    protected static string $view = 'filament.pages.list-machines';

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
            Actions\Action::make('createProcess')
                ->label('New process')
                // ->form([
                //     Forms\Components\TextInput::make('title')
                // ])
                ->modalHeading('Welcome')
                ->action(function (array $data) {
                    dd($data);
                    Process::create([
                        'name' => $data['name'],
                    ]);
                })

        ];
    }
}
