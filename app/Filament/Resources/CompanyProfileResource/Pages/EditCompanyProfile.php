<?php

namespace App\Filament\Resources\CompanyProfileResource\Pages;

use App\Filament\Resources\CompanyProfileResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCompanyProfile extends EditRecord
{
    protected static string $resource = CompanyProfileResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function afterSave(): void
    {
        // Sincronizar imagens para o diretório público
        $record = $this->record;
        $record->refresh();
        if ($record->logo) {
            \App\Helpers\FileSyncHelper::syncToPublic($record->logo);
        }
        if ($record->photos && is_array($record->photos)) {
            \App\Helpers\FileSyncHelper::syncMultipleToPublic($record->photos);
        }
    }
}
