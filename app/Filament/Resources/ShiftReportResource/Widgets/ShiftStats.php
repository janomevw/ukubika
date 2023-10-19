<?php

namespace App\Filament\Resources\ShiftReportResource\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Database\Eloquent\Model;
use Filament\Http\Events\RecordUpdated;

class ShiftStats extends BaseWidget
{
    public ?Model $record = null;

    protected static ?string $pollingInterval = null;

    protected $listeners = ['refresh_stats' => '$refresh'];

    protected function getStats(): array
    {
        return [
            Stat::make('Shift Input', $this->record->input_weight . ' MT'),
            Stat::make('Shift Output', $this->record->output_weight . ' MT'),
            Stat::make('Coil Ends', $this->record->coil_ends_weight . ' MT'),
        ];
    }


}
