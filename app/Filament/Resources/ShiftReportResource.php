<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ShiftReportResource\Pages;
use App\Filament\Resources\ShiftReportResource\RelationManagers\DelaysRelationManager;
use App\Infolists\Components\Table as ComponentsTable;
use App\Models\ShiftReport;
use App\Models\User;
use Awcodes\FilamentTableRepeater\Components\TableRepeater;
use Carbon\Carbon;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Infolists\Components\Section as ComponentsSection;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\Summarizers\Sum;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

class ShiftReportResource extends Resource
{
    protected static ?string $model = ShiftReport::class;

    protected static ?string $navigationIcon = 'heroicon-m-newspaper';

    protected static ?string $navigationGroup = 'CRM Production';

    protected static ?string $navigationLabel = 'Shift Reports';

    protected static ?int $navigationSort = 1;

     public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
                    ->columns(6)
                    ->schema([
                        DatePicker::make('report_date')
                            ->label('Date')
                            ->native(false)
                            ->displayFormat('d/m/Y')
                            ->columnSpan(2),

                        Select::make('report_shift')
                            ->label('Shift')
                            ->options([
                                'day' => 'Day',
                                'night' => 'Night',
                            ])
                            ->native(false)
                            ->columnSpan(2),

                        Select::make('user_id')
                            ->label('Foreman')
                            ->options(User::where('line_id','=','1')->pluck('name','id'))
                            ->native(false)
                            ->columnSpan(2),

                    ]),

                Section::make()
                    ->columns(6)
                    ->schema([
                        Grid::make('Order items')
                        ->schema(static::getFormSchema('shift_report_lines'))
                        ->columnSpan(6),
                    ]),

                Section::make()
                    ->columns(6)
                    ->schema([
                        Tabs::make('Label')
                            ->tabs([
                                Tabs\Tab::make('Safety')
                                    ->schema([
                                        Textarea::make('safety')
                                            ->hiddenLabel()
                                    ]),

                                Tabs\Tab::make('Quality')
                                    ->schema([
                                        Textarea::make('quality')
                                            ->hiddenLabel()
                                    ]),

                                Tabs\Tab::make('Other')
                                    ->schema([
                                        Textarea::make('other')
                                        ->hiddenLabel()
                                    ]),
                    ])
                    ->columnSpanFull()
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('report_date')
                    ->label('Date')
                    ->date('Y-m-d')
                    ->sortable('desc')
                    ->searchable(),

                TextColumn::make('report_shift')
                    ->label('Shift')
                    ->formatStateUsing(fn (string $state): string => Str::title($state)),

                TextColumn::make('output_weight')
                    ->label('Tonnage')
                    ->summarize(Sum::make()->label('Total')),

                TextColumn::make('foreman.name')
                    ->toggleable(isToggledHiddenByDefault: true)
            ])
            ->filters([
                Filter::make('report_date')

                    ->form([
                        DatePicker::make('report_date')
                            ->native(false),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['report_date'] ?? null,
                                fn (Builder $query, $date): Builder => $query->whereDate('report_date', '=', $date),
                            );
                    })
                    ->indicateUsing(function (array $data): array {
                        $indicators = [];
                        if ($data['report_date'] ?? null) {
                            $indicators['report_date'] = 'Shift Report(s) for: ' . Carbon::parse($data['report_date'])->format('d/m/Y');
                        }

                        return $indicators;
                    }),
            ])
            ->defaultSort('report_date', 'desc')
            ->actions([
                Tables\Actions\ViewAction::make()
                    ->outlined()
                    ->button(),

                Tables\Actions\EditAction::make()
                    ->icon('heroicon-m-pencil')
                    ->outlined()
                    ->button(),

                Tables\Actions\RestoreAction::make()

            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make()
                    ->icon('heroicon-m-plus'),
            ])
            ->recordAction(null)
            ->defaultGroup('report_date')
            ->defaultSort('report_date', 'desc');
    }

    public static function getRelations(): array
    {
        return [
            DelaysRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListShiftReports::route('/'),
            'create' => Pages\CreateShiftReport::route('/create'),
            'view' => Pages\ViewShiftReport::route('/{record}'),
            'edit' => Pages\EditShiftReport::route('/{record}/edit'),
        ];
    }

    public static function getFormSchema(?string $section = null): array
    {
        if ($section === 'shift_report_lines') {
            return [
                    TableRepeater::make('shift_report_lines')
                        ->hideLabels()
                        ->columnWidths([
                            'grade' => '200px',
                            'width' => '200px',
                        ])
                        ->addActionLabel('Add Production Order Run')
                        ->relationship()
                        ->schema([
                            Select::make('width')
                                ->options([
                                    '762'  => '762',
                                    '925'  => '925',
                                    '1220' => '1220',
                                    '1225' => '1225',
                                ])
                                ->placeholder('Width')
                                ->native(false),

                            TextInput::make('thickness')
                                ->numeric()
                                ->required(),

                            TextInput::make('input_weight')
                                ->numeric()
                                ->required(),

                            TextInput::make('output_weight')
                                ->numeric()
                                ->required(),

                            Select::make('grade')
                                ->options([
                                    'prime' => 'Prime',
                                    'rework' => 'Rework',
                                    'seconds' => 'Seconds',
                                    'reworked' => 'Reworked',
                                ])
                                ->placeholder('Grade')
                                ->required()
                                ->native(false),

                            TextInput::make('production_order')
                                ->label('Order')
                                ->numeric()
                                ->required(),
                            ])
                            ->columnSpanFull()
            ];
        }
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        $coil_ends = ($infolist->record->input_weight -$infolist->record->output_weight);
        $delay_start_time = Carbon::parse($infolist->record->delay_start)->format('H:m');

        return $infolist
            ->schema([
                ComponentsSection::make()
                    ->columns([
                        'sm' => 3,
                        'xl' => 3,
                    ])
                    ->schema([
                        ComponentsTable::make()->columnSpanFull(),
                    ]),
            ]);

    }
}
