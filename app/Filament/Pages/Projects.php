<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class Projects extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.projects';
    protected static ?int $navigationSort = 5;
}
