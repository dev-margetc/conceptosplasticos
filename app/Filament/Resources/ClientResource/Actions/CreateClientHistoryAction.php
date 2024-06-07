<?php

namespace App\Filament\Resources\ClienteResource\Actions;

use Filament\Forms;
use Filament\Tables\Actions\Action;
use App\Models\ClientHistory;
use App\Models\ProjectStatus;
use Illuminate\Support\Facades\Auth;

class CreateClientHistoryAction extends Action
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->name('create_history')
            ->label('Status')
            ->icon('heroicon-c-pencil')
            ->form([
                Forms\Components\Select::make('project_status_id')
                    ->label('Estado del Proyecto')
                    ->options(ProjectStatus::all()->pluck('description', 'id'))
                    ->required(),
                Forms\Components\Textarea::make('comments')
                    ->label('Comentarios')
                    ->required(),
            ])
            ->action(function (array $data, $record) {
                ClientHistory::create([
                    'client_id' => $record->id,
                    'project_status_id' => $data['project_status_id'],
                    'comments' => $data['comments'],
                    'user_id' => Auth::id(),
                ]);
            });
    }
}