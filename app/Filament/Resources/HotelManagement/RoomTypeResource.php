<?php

namespace App\Filament\Resources\HotelManagement;

use App\Filament\Resources\HotelManagement;
use App\Filament\Resources\RoomTypeResource\Pages;
use App\Filament\Resources\RoomTypeResource\RelationManagers;
use App\Models\RoomType;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class RoomTypeResource extends Resource
{
    protected static ?string $model = RoomType::class;

    protected static ?string $navigationIcon = 'heroicon-o-adjustments-horizontal';

    protected static ?string $pluralModelLabel = 'Типы комнат';

    protected static ?string $navigationGroup = 'Управление отелями';

    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('type')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('type')
                    ->searchable(),
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
                    ? __('messages.filament.table.no_records', ['resource' => 'типов комнат'])
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
            'index' => HotelManagement\RoomTypeResource\Pages\ListRoomTypes::route('/'),
            'create' => HotelManagement\RoomTypeResource\Pages\CreateRoomType::route('/create'),
            'edit' => HotelManagement\RoomTypeResource\Pages\EditRoomType::route('/{record}/edit'),
        ];
    }
}
