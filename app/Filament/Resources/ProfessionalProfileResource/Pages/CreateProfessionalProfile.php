<?php

namespace App\Filament\Resources\ProfessionalProfileResource\Pages;

use App\Filament\Resources\ProfessionalProfileResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateProfessionalProfile extends CreateRecord
{
    protected static string $resource = ProfessionalProfileResource::class;

    protected function afterCreate(): void
    {
        // Sincronizar is_public com is_active do User
        $record = $this->record;
        if ($record->user && isset($this->data['is_public'])) {
            $record->user->update([
                'is_active' => (bool) $this->data['is_public'],
            ]);
        }
    }
}
