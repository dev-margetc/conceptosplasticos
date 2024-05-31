<?php

namespace App\Filament\Resources\FranchiseResource\Pages;

use App\Filament\Resources\FranchiseResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListFranchises extends ListRecords
{
    protected static string $resource = FranchiseResource::class;
    protected static string $view = 'filament.pages.list-franchises';

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
    protected function listFranchises(){
        return  $this->getTableQuery()->paginate($this->getLayoutData());
    }
}
