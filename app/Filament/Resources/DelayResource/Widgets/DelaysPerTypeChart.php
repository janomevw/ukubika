<?php

namespace App\Filament\Resources\DelayResource\Widgets;

use App\Filament\Resources\DelayResource\Pages\ListDelays;
use Filament\Widgets\ChartWidget;
use Filament\Widgets\Concerns\InteractsWithPageTable;
use Illuminate\Support\Facades\DB;

class DelaysPerTypeChart extends ChartWidget
{
    use InteractsWithPageTable;

    protected static ?string $heading = 'Delays per Type';

    protected static ?string $pollingInterval = null;

    protected static ?string $maxHeight = '200px';

    protected $listeners = ['updateChartData' => 'update'];


    public function update()
    {
        $this->updateChartData();
    }

    protected function getTablePage(): string
    {
        return ListDelays::class;
    }

    protected function getData(): array
    {
        $query = $this->getPageTableQuery()->select('type', DB::raw('sum(duration) as duration'))->groupBy('type')->get();

        $types = $query->pluck('type')->toArray();

        $duration = $query->pluck('duration')->toArray();

        return [
            'datasets' => [
                [
                    'label' => 'minutes',
                    'data' => $duration,
                    'borderWidth' => 0,
                    'backgroundColor' => ['#3b73ed', '#315d9c '],
                    'hoverOffset' => 4,
                    'datalabels' => [
                        'enabled' => true,
                    ],
                ],
            ],
            'options' => [
                'tooltips' => [
                    'enabled' => true,
                ],
            ],
            'labels' => $types,

        ];
    }

    protected function getType(): string
    {
        return 'doughnut';
    }
}
