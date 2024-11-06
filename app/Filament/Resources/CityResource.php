<?php

namespace App\Filament\Resources;

use App\Models\City;
use App\Filament\Resources\CityResource\Pages;
use Filament\Forms\Components\Actions;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class CityResource extends Resource
{
    protected static ?string $model = City::class;

    protected static ?string $navigationIcon = 'heroicon-o-globe-alt';

    protected static ?string $pluralModelLabel = 'Города';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->label('Название города')
                    ->required()
                    ->maxLength(255)
                    ->reactive(),

                TextInput::make('slug')
                    ->label('Краткое обозначение')
                    ->required()
                    ->suffixAction(
                        Actions\Action::make('generateSlug')
                            ->label("Сгенерировать Slug")
                            ->icon('heroicon-o-arrow-path')
                            ->action(function (Forms\Set $set, Forms\Get $get) {
                                $set('slug', Str::slug($get('name')));
                            })
                            ->disabled(fn(Forms\Get $get) => empty($get('name')))
                    )
                    ->reactive()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Название города')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('slug')
                    ->label('Краткое обозначение')
                    ->sortable()
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
                    ? __('messages.filament.table.no_records', ['resource' => 'городов'])
                    : __('messages.filament.table.no_search_results')
            )
            ->emptyStateIcon('heroicon-o-globe-alt')
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
            'index' => Pages\ListCities::route('/'),
            'create' => Pages\CreateCity::route('/create'),
            'edit' => Pages\EditCity::route('/{record}/edit'),
        ];
    }
}
