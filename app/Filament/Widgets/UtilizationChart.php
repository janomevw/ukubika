<?php

namespace App\Filament\Widgets;

use Leandrocfe\FilamentApexCharts\Widgets\ApexChartWidget;

class UtilizationChart extends ApexChartWidget
{
    protected static string $chartId = 'utilizationChart';

    protected static ?string $pollingInterval = null;

    protected static ?string $heading = 'UtilizationChart';

    protected function getOptions(): array
    {
        return [
            'chart' => [
                'type' => 'line',
                'height' => 300,
            ],
            'series' => [
                [
                    'name' => 'Column',
                    'data' => [20, 40, 60, 100, 140, 70, 20, 90, 100, 150, 130, 180],
                    'type' => 'column',
                ],
                [
                    'name' => 'Line',
                    'data' => [10, 20, 30, 50, 40, 70, 30, 10, 60, 80, 20, 18],
                    'type' => 'line',
                ],
            ],
            'stroke' => [
                'width' => [0, 4],
            ],
            'xaxis' => [
                'categories' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                'labels' => [
                    'style' => [
                        'fontFamily' => 'inherit',
                    ],
                ],
            ],
            'yaxis' => [
                'labels' => [
                    'style' => [
                        'fontFamily' => 'inherit',
                    ],
                ],
            ],
            'legend' => [
                'labels' => [
                    'fontFamily' => 'inherit',
                ],
            ],
        ];
    }
}
