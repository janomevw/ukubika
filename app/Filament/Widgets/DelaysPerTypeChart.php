<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\DelayResource\Pages\ListDelays;
use Filament\Widgets\Concerns\InteractsWithPageTable;
use Illuminate\Support\Facades\DB;
use Leandrocfe\FilamentApexCharts\Widgets\ApexChartWidget;

class DelaysPerTypeChart extends ApexChartWidget
{
    use InteractsWithPageTable;

    protected static string $chartId = 'delaysPerTypeChart';

    protected static ?string $heading = 'Delays per Type';

    protected static ?int $contentHeight = 300;

    protected static ?string $pollingInterval = null;

    protected $listeners = ['updateChartData' => 'update'];

    protected function getTablePage(): string
    {
        return ListDelays::class;
    }

    public function update()
    {
        // $this->updateChartData();  // Chart.JS
        $this->updateOptions();  // ApexCharts.JS
    }

    protected function getOptions(): array
    {
        $query = $this->getPageTableQuery()->select('type', DB::raw('sum(duration) as duration'))->orderBy('type')->groupBy('type')->get();

        $types = $query->pluck('type')->toArray();

        $collection = collect($types);

        $collection->transform(function ($value) {
            return ucwords($value);
        });

        $collection->toArray();

        $duration = $query->pluck('duration')->toArray();

        $results = array_map('intval', $duration);

        return [
            'chart' => [
                'type' => 'donut',
                'height' => 300,
            ],
            'colors' => ['#059669', '#2563eb'],
            'fill' => [
                'type' => 'gradient',
                'gradient' => [
                    'type' => "vertical",
                    'shadeIntensity' => 0.5,
                    // 'color' => '#315d9c' , // optional, if not defined - uses the shades of same color in series
                    'inverseColors' => true,
                    'opacityFrom' => 1,
                    'opacityTo' => 1,
                    'stops' => [0, 50, 100],
                    ]
            ],
            'dataLabels' => [
                'dropShadow' => [
                    'enabled' => false,
                ],
            ],
            'animations' => [
                'enabled' => true,
                'easing' => 'easein',
                'speed' => 800,
                'animateGradually' => [
                    'enabled' => true,
                    'delay'=> 150
                ],
                'dynamicAnimation' => [
                    'enabled' => true,
                    'speed' => 350
                ]
            ],
            'stroke' => [
                'show' => true,
                'width' => 0,
            ],
            'series' => $results,
            'labels' => $collection,

            'legend' => [
                'labels' => [
                    'fontFamily' => 'inherit',
                ],
            ],
        ];
    }
}
