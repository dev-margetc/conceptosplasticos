<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class Production extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationLabel = 'Production';
    protected static ?int $navigationSort = 6;
    protected static string $view = 'filament.pages.production';
}
