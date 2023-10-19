<?php

namespace App\Filament\Resources\DelayResource\Pages;

use App\Filament\Resources\DelayResource;
use App\Filament\Widgets\DelaysPerTypeChart;
use App\Filament\Widgets\DelaysPerDepartmentChart;
use App\Filament\Widgets\UtilizationChart;
use Carbon\Carbon;
use Filament\Actions;
use Filament\Pages\Concerns\ExposesTableToWidgets;
use Filament\Resources\Pages\ListRecords;

use Filament\Tables;
use Filament\Tables\Columns\Summarizers\Sum;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Grouping\Group;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;
use Carbon\CarbonInterval;
use Filament\Forms\Components\DatePicker;
use Filament\Notifications\Notification;
use Filament\Tables\Actions\Action;

class ListDelays extends ListRecords
{
    use ExposesTableToWidgets;

    protected static string $resource = DelayResource::class;

    protected static ?string $recordUrl = null;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->outlined()
                ->icon('heroicon-m-plus')
                ->slideOver(),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            // DelaysPerDepartmentChart::class,
            // DelaysPerTypeChart::class,
            // UtilizationChart::class,
        ];
    }

    public function getColumns(): int | string | array
    {
        return 2;
    }

    public function table(Table $table): Table
    {
        return $table
            ->headerActions([
                Action::make('dashboard')
                    ->label('Test Action')
                    ->color('report')
                    ->outlined()
                    ->action(function(){
                        Notification::make()
                            ->title('something')
                            ->success()
                            ->send();
                    })
            ])
            ->columns([
                TextColumn::make('report_date')
                    ->date('Y-m-d')
                    ->sortable('desc'),

                TextColumn::make('shift')
                    ->formatStateUsing(fn (string $state): string => Str::title($state)),

                TextColumn::make('type')
                    ->label('Type')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'planned' => 'primary',
                        'unplanned' => 'warning',
                    })
                    ->formatStateUsing(fn (string $state): string => Str::title($state))
                    ->toggleable(),

                TextColumn::make('reason')
                    ->searchable()
                    ->limit(50)
                    ->toggleable(),

                TextColumn::make('department.department')
                    ->toggleable(isToggledHiddenByDefault: false),

                TextColumn::make('delay_start')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->dateTime('Y-m-d H:i'),

                TextColumn::make('delay_end')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->dateTime('Y-m-d H:i'),


                TextColumn::make('duration')
                    ->summarize([
                        Sum::make()->label('Duration')->numeric(),
                    ])
                    ->formatStateUsing(fn (string $state): string => CarbonInterval::minutes($state)->addHours()->forHumans()),
            ])
            ->paginated([10, 25, 50, 100, 250, 500])
            ->deferLoading()
            ->groups([
                Group::make('report_date')
                    ->label('Report Date')
                    ->collapsible(),
                Group::make('shift')
                    ->label('Shift')
                    ->collapsible(),
                Group::make('type')
                    ->label('Type')
                    ->collapsible(),
            ])
            ->recordAction(null)
            ->defaultSort('report_date', 'desc')
            ->filters([
                Filter::make('report_date')
                    ->form([
                        DatePicker::make('created_from')
                            ->native(false)
                            ->displayFormat('Y-m-d'),
                        DatePicker::make('created_until')
                            ->displayFormat('Y-m-d')
                            ->native(false),
                    ])
                    ->baseQuery(function (Builder $query, array $data): Builder {
                        $this->dispatch('updateChartData'); //let's try and see if this will updat the chart data  // had to move the whole table object to the list page.........  go figure .......
                        return $query
                            ->when(
                                $data['created_from'] ?? null,
                                fn (Builder $query, $date): Builder => $query->whereDate('report_date', '>=', $date),
                            )
                            ->when(
                                $data['created_until'] ?? null,
                                fn (Builder $query, $date): Builder => $query->whereDate('report_date', '<=', $date),
                            );
                    })
                    ->indicateUsing(function (array $data): array {
                        $indicators = [];
                        if ($data['created_from'] ?? null) {
                            $indicators['created_from'] = 'Delays from ' . Carbon::parse($data['created_from'])->format('d M Y');
                        }
                        if ($data['created_until'] ?? null) {
                            $indicators['created_until'] = 'Delays until ' . Carbon::parse($data['created_until'])->format('d M Y');
                        }

                        return $indicators;
                    }),


                SelectFilter::make('department')
                            ->native(false)
                            ->relationship('department', 'department'),

                SelectFilter::make('type')
                            ->native(false)
                            ->options([
                                'planned'    => 'Planned',
                                'unplanned' => 'Unplanned',
                            ]),
                SelectFilter::make('shift')
                            ->native(false)
                            ->options([
                                'day'    => 'Day',
                                'nights' => 'Night',
                            ]),

            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->icon('heroicon-m-pencil')
                    ->button()
                    ->outlined()
                    ->slideOver(),

                Tables\Actions\DeleteAction::make()
                    ->button()
                    ->outlined()
            ]);
            // ->bulkActions([
            //     Tables\Actions\BulkActionGroup::make([
            //         Tables\Actions\DeleteBulkAction::make(),
            //     ]),
            // ]);
    }

    // public function getTabs(): array
    // {
    //     $this->dispatch('updateChartData');

    //     return [
    //         'month' => ListRecords\Tab::make()->query(fn ($query) => $query->whereBetween('report_date', [Carbon::today()->subMonth()->format('Y-m-d'), Carbon::today()->format('Y-m-d')])),
    //         'week'  => ListRecords\Tab::make()->query(fn ($query) => $query->whereBetween('report_date', [Carbon::today()->subWeek()->format('Y-m-d'), Carbon::today()->format('Y-m-d')])),
    //         null    => Tab::make('All')
    //     ];

    // }
}
