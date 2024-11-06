<?php

namespace App\Filament\Resources\UserManagement\ClientResource\Pages;

use App\Filament\Resources\UserManagement\ClientResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListClients extends ListRecords
{
    protected static string $resource = ClientResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
