<?php

namespace App\Filament\Resources\FirmaResource\Pages;

use App\Filament\Resources\FirmaResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditFirma extends EditRecord
{
    protected static string $resource = FirmaResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
