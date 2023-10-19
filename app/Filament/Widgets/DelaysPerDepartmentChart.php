<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\DelayResource\Pages\ListDelays;
use Filament\Support\RawJs;
use Filament\Widgets\Concerns\InteractsWithPageTable;
use Illuminate\Support\Facades\DB;
use Leandrocfe\FilamentApexCharts\Widgets\ApexChartWidget;

class DelaysPerDepartmentChart extends ApexChartWidget
{
    use InteractsWithPageTable;

    protected static string $chartId = 'DelaysPerDepartmentChart';

    protected static ?string $heading = 'Delays per Department';

    protected static ?int $contentHeight = 300; //px

    protected static ?string $pollingInterval = null;

    protected $listeners = ['updateChartData' => 'update'];

    protected function getTablePage(): string
    {
        return ListDelays::class;
    }

    public function update()
    {
        // $this->updateChartData();
        $this->updateOptions();
    }

    protected function getOptions(): array
    {
        $query = $this->getPageTableQuery()->join('departments', 'delays.department_id', 'departments.id')->select('departments.department', DB::raw('sum(duration) as duration'))->groupBy('departments.department')->get();

        $departments = $query->pluck('department')->toArray();

        $duration = $query->pluck('duration')->toArray();

        return [
            'chart' => [
                'type' => 'bar',
                'height' => 300,
            ],
            'series' => [
                [
                    'name' => 'minutes',
                    'data' => $duration,
                ],
            ],
            'xaxis' => [
                'categories' => $departments,
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
            'colors' => ['#2563eb'],
            'fill' => [
                'colors' => '#2563eb',
            ],
            'plotOptions' => [
                'bar' => [
                    'borderRadius' => 2,
                    'horizontal' => false,
                    'dataLabels' => [
                        'position' => 'top',
                    ]
                ],
            ],
            'dataLabels' => [
                'enabled' => true,
                // 'offsetX' => 30,
                'offsetY' => -20,
                'style' => [
                    'fontSize' => '12px',
                ],
                'inherit' => [
                    'fontColor' => true,
                ]
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
            ]
        ];
    }
}
