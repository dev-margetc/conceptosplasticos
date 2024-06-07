<?php

namespace App\Filament\Resources\ClientResource\Pages;

use Filament\Actions;
use App\Models\ClientHistory;
use Illuminate\Support\Facades\Auth;
use App\Filament\Resources\ClientResource;
use Filament\Resources\Pages\CreateRecord;

class CreateClient extends CreateRecord
{
    protected static string $resource = ClientResource::class;
    private $historialData = [];

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // dd('aqui');
        // Separate the data for client and client_histories
        $this->historialData = [
            'project_status_id' => $data['project_status_id'],
            'comments' => $data['comments'],
            'user_id' => Auth::id(), // Assuming the authenticated user is the one creating the record
        ];

        // Remove historial data from the main data array
        unset($data['project_status_id'], $data['comments']);

        return $data;
    }

    protected function afterCreate(): void
    {
        // parent::afterCreate();

        ClientHistory::create([
            'client_id' => $this->record->id,
            'project_status_id' => $this->historialData['project_status_id'],
            'user_id' => $this->historialData['user_id'],
            'comments' => $this->historialData['comments'],
        ]);
    }

}
