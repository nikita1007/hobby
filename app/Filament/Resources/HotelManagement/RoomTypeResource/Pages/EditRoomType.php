<?php

namespace App\Filament\Resources\HotelManagement\RoomTypeResource\Pages;

use App\Filament\Resources\HotelManagement\RoomTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditRoomType extends EditRecord
{
    protected static string $resource = RoomTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
