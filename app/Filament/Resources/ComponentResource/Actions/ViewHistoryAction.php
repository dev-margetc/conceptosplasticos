<?php

namespace App\Filament\Resources\ComponentResource\Actions;

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
            ->button()
            ->modalHeading('View log')
            ->modalWidth('lg')
            ->modalWidth(MaxWidth::SevenExtraLarge)
            ->modalContent(fn ($record) => view('filament.pages.component-resource.view-history', [
                'componentId' => $record->id,
            ]));
    }
}