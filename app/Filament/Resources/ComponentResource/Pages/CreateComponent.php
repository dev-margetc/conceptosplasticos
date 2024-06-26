<?php

namespace App\Filament\Resources\ComponentResource\Pages;

use Filament\Actions;
use App\Models\Component;
use Filament\Resources\Pages\CreateRecord;
use App\Filament\Resources\ComponentResource;
use Illuminate\Validation\ValidationException;
use Filament\Notifications\Notification;

class CreateComponent extends CreateRecord
{
    protected static string $resource = ComponentResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $selectedMaterials = array_filter($data['raw_materials'], fn($material) => isset($material['percentage']) && $material['percentage'] > 0);

        if (empty($selectedMaterials)) {
            Notification::make()
                ->title('Debe asignar al menos un material con un porcentaje.')
                ->warning()
                ->send();
            throw ValidationException::withMessages([
                'raw_materials' => 'Debe asignar al menos un material con un porcentaje.',
            ]);
        }

        $totalPercentage = array_sum(array_column($selectedMaterials, 'percentage'));

        if ($totalPercentage != 100) {
            Notification::make()
                ->title('La suma de los porcentajes debe ser igual a 100.')
                ->warning()
                ->send();
            throw ValidationException::withMessages([
                'raw_materials' => 'La suma de los porcentajes debe ser igual a 100.',
            ]);
        }
        unset($data['raw_materials']);
        $component = Component::create($data);

        foreach ($selectedMaterials as $materialId => $materialData) {
            $component->rawMaterial()->attach($materialId, ['percentage' => $materialData['percentage']]);
        }

        return $data;
    }

}