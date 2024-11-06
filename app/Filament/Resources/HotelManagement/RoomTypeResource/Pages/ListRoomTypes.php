<?php

namespace App\Filament\Resources\HotelManagement\RoomTypeResource\Pages;

use App\Filament\Resources\HotelManagement\RoomTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListRoomTypes extends ListRecords
{
    protected static string $resource = RoomTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
