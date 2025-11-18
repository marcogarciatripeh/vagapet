<?php

namespace App\Filament\Resources\ProfessionalProfileResource\Pages;

use App\Filament\Resources\ProfessionalProfileResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditProfessionalProfile extends EditRecord
{
    protected static string $resource = ProfessionalProfileResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function afterSave(): void
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
