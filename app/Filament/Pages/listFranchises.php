<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class listFranchises extends Page
{
    protected static bool $shouldRegisterNavigation = false;
    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static string $view = 'filament.pages.list-franchises';
}
