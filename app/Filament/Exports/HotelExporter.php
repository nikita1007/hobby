<?php

namespace App\Filament\Exports;

use App\Models\City;
use App\Models\Hotel;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Illuminate\Database\Eloquent\Builder;
use Filament\Actions\Exports\Models\Export;
use Filament\Forms\Components\Select;

class HotelExporter extends Exporter
{
    protected static ?string $model = Hotel::class;

    // Переменная для хранения выбранных значений города
    protected static array $selectedCityIds = [];

    public static function modifyQuery(Builder $query): Builder
    {
        // Получаем выбранные города для фильтрации
        if (!empty(static::$selectedCityIds)) {
            $query->whereIn('city_id', static::$selectedCityIds);
        }

        return $query->with('city');
    }

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('id')
                ->label('ID')
                ->enabledByDefault(false),
            ExportColumn::make('city.name')->label('Город'),
            ExportColumn::make('name')->label('Наименование'),
            ExportColumn::make('description')->label('Описание'),
            ExportColumn::make('stars')->label('Количество звезд'),
        ];
    }

    public static function getOptionsFormComponents(): array
    {
        return [
            Select::make('city_ids')
                ->label('Выберите города для экспорта')
                ->options(City::all()->pluck('name', 'id'))
                ->multiple()
                ->searchable()
                ->placeholder('Все города')
                ->afterStateUpdated(function ($state) {
                    static::$selectedCityIds = $state ?? [];
                }), // Добавляет пункт для выбора всех
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Ваш экспорт отелей завершен, ' . number_format($export->successful_rows) . ' ' . str('строка')->plural($export->successful_rows) . ' были экспортированы.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('строка')->plural($failedRowsCount) . ' не удалось экспортировать.';
        }

        return $body;
    }
}
