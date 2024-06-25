<?php

namespace App\Filament\Resources\ClientResource\Pages;

use Filament\Actions;
use App\Models\ClientHistory;
use Illuminate\Support\Facades\Auth;
use App\Filament\Resources\ClientResource;
use App\Models\Project;
use Filament\Resources\Pages\CreateRecord;

class CreateClient extends CreateRecord
{
    protected static string $resource = ClientResource::class;
    private $historialData = [];
    private $projectData = [];

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // dd($data['project']['name']);
        if(isset($data['project']['name']) && !empty($data['project']['name'])){
            $statusProject = $data['project_status_id'] >= 7 ? 0 : 1;
            $this->projectData = [
                // 'client_id' => $this->record->id,
                'name' => $data['project']['name'],
                'status' => $statusProject
            ];

        }
        
        $this->historialData = [
            'project_status_id' => $data['project_status_id'],
            'comments' => $data['comments'],
            'user_id' => Auth::id(), 
        ];

        // Remove historial data from the main data array
        unset($data['project_status_id'], $data['comments'], $data['project']['name']);

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

        if (!empty($this->projectData)) {
            Project::create([
                'client_id' => $this->record->id,
                'name' => $this->projectData['name'],
                'status' => $this->projectData['status']
            ]);
        }
    }

}
