<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DelayResource\Pages;
use App\Filament\Resources\DelayResource\Widgets\DelaysPerDepartmentChart;
use App\Models\Delay;
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
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\Summarizers\Sum;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Grouping\Group;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

class DelayResource extends Resource
{
    protected static ?string $model = Delay::class;

    protected static ?string $navigationIcon = 'heroicon-m-clock';

    protected static ?string $navigationGroup = 'CRM Production';

    protected static ?string $navigationLabel = 'Delays';

    protected static ?int $navigationSort = 2;


    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                DateTimePicker::make('delay_start')
                    ->native(false)
                    ->required()
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

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            // DelaysPerDepartmentChart::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListDelays::route('/'),
            // 'create' => Pages\CreateDelay::route('/create'),
            // 'edit' => Pages\EditDelay::route('/{record}/edit'),
        ];
    }
}
