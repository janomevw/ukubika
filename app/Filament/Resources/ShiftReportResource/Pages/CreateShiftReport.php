<?php

namespace App\Filament\Resources\ShiftReportResource\Pages;

use App\Filament\Resources\ShiftReportResource;
use Filament\Actions\Action;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;


class CreateShiftReport extends CreateRecord
{
    protected static string $resource = ShiftReportResource::class;

    protected static bool $canCreateAnother = false;

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

    protected function handleRecordCreation(array $data): Model
    {
        $results = $this->shift_total();

        $shift_report = static::getModel()::create([
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

        return $shift_report;
    }

    protected function getCreateFormAction(): Action
    {
        return Action::make('create')
            ->label(__('filament-panels::resources/pages/create-record.form.actions.create.label'))
            ->submit('create')
            ->outlined()
            ->icon('heroicon-m-squares-plus')
            ->keyBindings(['ctrl+s']);
    }

    protected function getCancelFormAction(): Action
    {
        return Action::make('cancel')
            ->label(__('filament-panels::resources/pages/create-record.form.actions.cancel.label'))
            ->url($this->previousUrl ?? static::getResource()::getUrl())
            ->outlined()
            ->icon('heroicon-m-arrow-uturn-left')
            ->color('gray');
    }
}
