<?php

namespace App\Filament\Resources\ShiftReportResource\Pages;

use App\Filament\Resources\ShiftReportResource;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Infolists\Components\Fieldset;
use Filament\Infolists\Components\Grid;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Concerns\InteractsWithInfolists;
use Filament\Infolists\Contracts\HasInfolists;
use Filament\Infolists\Infolist;
use Filament\Resources\Pages\ViewRecord;
use Illuminate\Contracts\View\View;

class ViewShiftReport extends ViewRecord implements HasInfolists
{
    use InteractsWithInfolists;

    protected static string $resource = ShiftReportResource::class;

    protected static ?string $modelLabel = 'CRM';

    protected static ?string $title = 'CRM Production Report';

    protected function getActions(): array
    {
        return [
            Actions\EditAction::make()
                ->icon('heroicon-o-pencil')
                ->outlined(),

            Actions\Action::make('cancel')
                ->icon('heroicon-m-arrow-uturn-left')
                ->url(fn () => ShiftReportResource::getUrl())
                ->color('report')
                ->outlined(),
        ];
    }

    public function getRelationManagers(): array
    {
        return [];
    }

}
