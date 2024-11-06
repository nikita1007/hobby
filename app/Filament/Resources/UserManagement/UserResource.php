<?php

namespace App\Filament\Resources\UserManagement;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Filament\Resources\UserManagement;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    protected static ?string $pluralModelLabel = 'Пользователи';

    protected static ?string $navigationGroup = 'Управление пользователями';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label("Имя пользователя")
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('email')
                    ->label("Почта")
                    ->email()
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('password')
                    ->label("Пароль")
                    ->password()
                    ->required()
                    ->maxLength(255)
                    ->confirmed(),
                Forms\Components\TextInput::make('password_confirmation')
                    ->label("Подтверждение пароля")
                    ->password()
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label("Имя пользователя")
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->label("Почта")
                    ->searchable(),
                Tables\Columns\TextColumn::make('email_verified_at')
                    ->placeholder('Не подтверждена')
                    ->label("Почта подтверждена в")
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('created_at')
                    ->label("Дата создания")
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label("Дата последнего обновления")
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->emptyStateHeading(
                fn() => ! request()->has('tableSearch')
                    ? __('messages.filament.table.no_records', ['resource' => 'пользователей'])
                    : __('messages.filament.table.no_search_results')
            )
            ->emptyStateIcon('heroicon-o-user-plus')
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
            'index' => UserManagement\UserResource\Pages\ListUsers::route('/'),
            'create' => UserManagement\UserResource\Pages\CreateUser::route('/create'),
            'edit' => UserManagement\UserResource\Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
