<?php

namespace App\Filament\Resources\FirmaResource\Pages;

use App\Filament\Resources\FirmaResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListFirmas extends ListRecords
{
    protected static string $resource = FirmaResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
