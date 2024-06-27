<?php

namespace App\Filament\Pages;

use App\Models\Project;
use Filament\Pages\Page;
use Filament\Forms\Components\Select;

class Projects extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.projects';
    protected static ?int $navigationSort = 5;

    protected function getFormSchema(): array
    {
        return [
            Select::make('project_id')
                ->label('Active Projects')
                ->options(Project::where('status', '0')->pluck('name', 'id'))
                ->searchable()
                ->required(),
        ];
    }

    protected function getViewData(): array
    {
        return [
            'form' => $this->form,
        ];
    }

    protected function getForms(): array
    {
        return [
            'form' => $this->makeForm()
                ->schema($this->getFormSchema())
                ->statePath('data'),
        ];
    }

}
