<?php

namespace App\Filament\Resources\CompanyProfileResource\Pages;

use App\Filament\Resources\CompanyProfileResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateCompanyProfile extends CreateRecord
{
    protected static string $resource = CompanyProfileResource::class;

    protected function afterCreate(): void
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
