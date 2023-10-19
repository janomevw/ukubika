<?php

namespace App\Filament\Resources\ShiftReportResource\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Database\Eloquent\Model;

class ShiftOutput extends BaseWidget
{
    public ?Model $record = null;

    protected static ?string $pollingInterval = null;

    protected function getStats(): array
    {
        return [
            Stat::make('Shift Output', $this->record->output_weight . ' MT')
        ];
    }
}
