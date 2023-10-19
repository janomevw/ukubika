<?php

namespace App\Filament\Widgets;

use Leandrocfe\FilamentApexCharts\Widgets\ApexChartWidget;

class ShiftReportPrimeYieldChart extends ApexChartWidget
{
    protected static string $chartId = 'PFT';

    protected static ?string $pollingInterval = null;

    protected static ?string $heading = 'ShiftReportPrimeYieldChart';

    protected function getOptions(): array
    {
        return [
            'chart' => [
                'type' => 'radialBar',
                'height' => 300,
            ],
            'series' => [75],
            'plotOptions' => [
                'radialBar' => [
                    'hollow' => [
                        'size' => '70%',
                    ],
                    'dataLabels' => [
                        'show' => true,
                        'name' => [
                            'show' => true,
                            'fontFamily' => 'inherit'
                        ],
                        'value' => [
                            'show' => true,
                            'fontFamily' => 'inherit',
                            'fontWeight' => 600,
                            'fontSize' => '20px'
                        ],
                    ],

                ],
            ],
            'stroke' => [
                'lineCap' => 'round',
            ],
            'labels' => ['Prime Yield'],
            'colors' => ['#f59e0b'],
        ];
    }
}
