<?php

namespace App\Filament\Resources\ShiftReportResource\RelationManagers;

use App\Models\Department;
use Carbon\Carbon;
use Carbon\CarbonInterval;
use Filament\Forms;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class DelaysRelationManager extends RelationManager
{
    protected static string $relationship = 'delays';

    public function form(Form $form): Form
    {
        return $form
            ->schema([

                DateTimePicker::make('delay_start')
                    ->required()
                    ->native(false)
                    ->label('Delay Start')
                    ->displayFormat('d/m/Y H:i')
                    ->seconds(false)
                    ->afterStateUpdated(function(string $operation, $state, Forms\Set $set, Get $get){
                        if (Carbon::parse($get('delay_start'))->format('H:i') > '05:59' && Carbon::parse($get('delay_start'))->format('H:i') < '18:00'){
                            $set('shift', 'day');
                        }
                        else {
                            $set('shift', 'night');
                        }
                    }),

                DateTimePicker::make('delay_end')
                    ->native(false)
                    ->required()
                    ->label('Delay End')
                    ->displayFormat('d/m/Y H:i')
                    ->seconds(false)
                    ->afterStateUpdated(function(string $operation, $state, Forms\Set $set, Get $get){
                        $set('duration', Carbon::parse($get('delay_end'))->diffInMinutes(Carbon::parse($get('delay_start'))));
                    }),

                Hidden::make('duration'),

                Hidden::make('report_date'),

                Hidden::make('shift'),

                Select::make('department_id')
                    ->native(false)
                    ->required()
                    ->label('Department')
                    ->options(Department::all()->pluck('department', 'id')),

                Select::make('type')
                    ->native(false)
                    ->required()
                    ->options([
                        'planned'   => 'Planned',
                        'unplanned' => 'Unplanned',
                    ]),

                Textarea::make('reason')
                    ->columnSpanFull()
                    ->required()
                    ->afterStateUpdated(function (string $state, Forms\Set $set, Get $get){
                        if (Carbon::parse($get('delay_start'))->format('H:i') > '23:59' || Carbon::parse($get('delay_start'))->format('H:i') < '06:00'){
                            $set('report_date', Carbon::create($get('delay_start'))->subDay()->format('Y-m-d'));
                        } else {
                            $set('report_date', Carbon::parse($get('delay_start'))->format('Y-m-d'));
                        }
                    }),

            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('department.department'),

                TextColumn::make('type')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'planned' => 'primary',
                        'unplanned' => 'warning',
                    })
                    ->formatStateUsing(fn (string $state): string => Str::title($state)),

                TextColumn::make('reason'),

                TextColumn::make('delay_start')
                    ->dateTime('H:i'),

                TextColumn::make('delay_end')
                    ->dateTime('H:i'),


                TextColumn::make('duration')
                    ->formatStateUsing(fn (string $state): string => CarbonInterval::minutes($state)->addHours()->forHumans()),
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                ActionGroup::make([
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make(),
                ])
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
