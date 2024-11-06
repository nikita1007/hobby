<?php

namespace App\Filament\Resources\UserManagement\UserResource\Pages;

use App\Filament\Resources\UserManagement\UserResource;
use Filament\Resources\Pages\CreateRecord;

class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;
}
