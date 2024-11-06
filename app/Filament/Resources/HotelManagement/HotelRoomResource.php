<?php

namespace App\Filament\Resources\HotelManagement;

use App\Filament\Resources\HotelRoomResource\Pages;
use App\Filament\Resources\HotelRoomResource\RelationManagers;
use App\Filament\Resources\HotelManagement;
use App\Models\HotelRoom;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class HotelRoomResource extends Resource
{
    protected static ?string $model = HotelRoom::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-office';

    protected static ?string $pluralModelLabel = 'Комнаты';

    protected static ?string $navigationGroup = 'Управление отелями';

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('hotel_id')
                    ->relationship('hotel', 'name')
                    ->required(),
                Forms\Components\Select::make('room_type_id')
                    ->relationship('roomType', 'id')
                    ->required(),
                Forms\Components\TextInput::make('number')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('capacity')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('price')
                    ->required()
                    ->numeric()
                    ->prefix('$'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('hotel.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('roomType.id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('number')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('capacity')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('price')
                    ->money()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->emptyStateHeading(
                fn() => ! request()->has('tableSearch')
                    ? __('messages.filament.table.no_records', ['resource' => 'комнат отелей'])
                    : __('messages.filament.table.no_search_results')
            )
            ->emptyStateIcon('heroicon-o-plus')
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => HotelManagement\HotelRoomResource\Pages\ListHotelRooms::route('/'),
            'create' => HotelManagement\HotelRoomResource\Pages\CreateHotelRoom::route('/create'),
            'edit' => HotelManagement\HotelRoomResource\Pages\EditHotelRoom::route('/{record}/edit'),
        ];
    }
}
