<?php

namespace App\Filament\Resources\ClienteResource\Actions;

use Filament\Tables\Actions\Action;
use Filament\Support\Enums\MaxWidth;

class ViewHistoryAction extends Action
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->name('view_history')
            ->label('View Log')
            ->icon('heroicon-s-eye')
            ->modalHeading('View log')
            ->modalWidth('lg')
            ->action(function (array $data, $record) {
                // No se requiere acción ya que solo estamos mostrando un modal
            })
            ->modalWidth(MaxWidth::FiveExtraLarge)
            ->modalContent(fn ($record) => view('filament.pages.client-resource.view-history', [
                'history' => $record->clientHistory()->with('projectStatus', 'user')->get(),
            ]));
    }
}