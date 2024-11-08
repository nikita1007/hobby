<?php

namespace App\Filament\Resources\HotelManagement;

use App\Filament\Exports\HotelExporter;
use App\Filament\Resources\HotelManagement;
use App\Models\City;
use App\Models\Hotel;
use Exception;
use Filament\Actions\Exports\Enums\ExportFormat;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ExportAction;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Artisan;

class HotelResource extends Resource
{
    protected static ?string $model = Hotel::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-office-2';

    protected static ?string $pluralModelLabel = 'Отели';

    protected static ?string $navigationGroup = 'Управление отелями';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('city_id')
                    ->relationship('city', 'name')
                    ->required(),
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Textarea::make('description')
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('stars')
                    ->required()
                    ->numeric()
                    ->minValue(1)
                    ->maxValue(5)
                    ->default(1),
            ]);
    }

    /**
     * @throws Exception
     */
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Наименование')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('city.name')
                    ->label('Город')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('stars')
                    ->label('Количетсво звезд')
                    ->numeric()
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
                fn() => !request()->has('tableSearch')
                    ? __('messages.filament.table.no_records', ['resource' => 'отелей'])
                    : __('messages.filament.table.no_search_results')
            )
            ->emptyStateIcon('heroicon-o-plus')
            ->filters([
                Tables\Filters\SelectFilter::make('city_id')
                    ->multiple()
                    ->label('Город')
                    ->options(function () {
                        return City::all()->pluck('name', 'id');
                    })
                    ->query(function ($query, $data) {
                        if (!empty($data['values'])) {
                            return $query->whereIn('city_id', $data['values']);
                        }
                        return $query;
                    }),
            ])
            ->actions([
                EditAction::make(),
            ])
            ->headerActions([
                ExportAction::make()->exporter(HotelExporter::class)
                    ->after(function () {
                        // Запуск очереди с автоостановкой после выполнения всех задач
                        Artisan::call('queue:work', [
                            '--stop-when-empty' => true,
                        ]);
                    })
                    ->formats([
                        ExportFormat::Csv,
                    ]),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
                Tables\Actions\ExportBulkAction::make()->exporter(HotelExporter::class)
                    ->after(function () {
                        // Запуск очереди с автоостановкой после выполнения всех задач
                        Artisan::call('queue:work', [
                            '--stop-when-empty' => true,
                        ]);
                    })
                    ->formats([
                        ExportFormat::Csv,
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
            'index' => HotelManagement\HotelResource\Pages\ListHotels::route('/'),
            'create' => HotelManagement\HotelResource\Pages\CreateHotel::route('/create'),
            'edit' => HotelManagement\HotelResource\Pages\EditHotel::route('/{record}/edit'),
        ];
    }
}
