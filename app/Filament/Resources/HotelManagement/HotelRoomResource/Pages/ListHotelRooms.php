<?php

namespace App\Filament\Resources\HotelManagement\HotelRoomResource\Pages;

use App\Filament\Resources\HotelManagement\HotelRoomResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListHotelRooms extends ListRecords
{
    protected static string $resource = HotelRoomResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
