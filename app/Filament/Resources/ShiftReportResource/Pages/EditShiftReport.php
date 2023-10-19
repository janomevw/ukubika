<?php

namespace App\Filament\Resources\ShiftReportResource\Pages;

use App\Filament\Resources\ShiftReportResource;
use App\Filament\Resources\ShiftReportResource\RelationManagers\DelaysRelationManager;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;
use Filament\Http\Events\RecordUpdated;

class EditShiftReport extends EditRecord
{
    protected static string $resource = ShiftReportResource::class;

    public ?string $activeRelationManager = null;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make()
                ->outlined()
                ->icon('heroicon-m-eye'),

            Actions\DeleteAction::make()
                ->outlined()
                ->icon('heroicon-m-trash'),
        ];
    }

    protected function getSaveFormAction(): Action
    {
        return Action::make('save')
            ->label(__('filament-panels::resources/pages/edit-record.form.actions.save.label'))
            ->submit('save')
            ->keyBindings(['ctrl+s'])
            ->outlined();
    }

    protected function getCancelFormAction(): Action
    {
        return Action::make('cancel')
            ->label(__('filament-panels::resources/pages/edit-record.form.actions.cancel.label'))
            ->url($this->previousUrl ?? static::getResource()::getUrl())
            ->color('gray')
            ->outlined();
    }

    protected function getHeaderWidgets(): array
    {
        return [
            ShiftReportResource\Widgets\ShiftStats::class,
        ];
    }

    protected function shift_total():array
    {
        $results = [
            'input_weight' => 0,
            'output_weight' => 0,
            'coil_ends_weight' => 0,
        ];


        foreach($this->data['shift_report_lines'] as $report_line)
        {
            $results['input_weight'] += $report_line['input_weight'];
            $results['output_weight'] += $report_line['output_weight'];
        }

        $results['coil_ends_weight'] = $results['input_weight'] - $results['output_weight'];

        return $results;
    }

    protected function handleRecordUpdate(Model $record, array $data): Model
    {
        $results = $this->shift_total();

        $record->update([
            'report_date'       =>  $data['report_date'],
            'report_shift'      =>  $data['report_shift'],
            'user_id'           =>  $data['user_id'],
            'input_weight'      =>  $results['input_weight'],
            'output_weight'     =>  $results['output_weight'],
            'coil_ends_weight'  =>  $results['coil_ends_weight'],
            'safety'            =>  $data['safety'],
            'quality'           =>  $data['quality'],
            'other'             =>  $data['other'],
        ]);

        $this->dispatch('refresh_stats');

        return $record->refresh();
    }


    public function getRelationManagers(): array
    {
        return [
            DelaysRelationManager::class
        ];
    }

}
