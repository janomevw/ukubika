<?php

namespace App\Filament\Resources\DelayResource\Widgets;

use App\Filament\Resources\DelayResource\Pages\ListDelays;
use App\Models\Delay;
use App\Models\Department;
use Filament\Widgets\ChartWidget;
use Filament\Widgets\Concerns\InteractsWithPageTable;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Support\Facades\DB;

use function Laravel\Prompts\select;

class DelaysPerDepartmentChart extends ChartWidget
{
    use InteractsWithPageTable;

    protected static ?string $heading = 'Delays per Department';

    protected static ?string $pollingInterval = null;

    protected static ?string $maxHeight = '300px';

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
        $query = $this->getPageTableQuery()->join('departments', 'delays.department_id', 'departments.id')->select('departments.department', DB::raw('sum(duration) as duration'))->groupBy('departments.department')->get();

        $departments = $query->pluck('department')->toArray();

        $duration = $query->pluck('duration')->toArray();

        return [
            'datasets' => [
                [
                    'label' => 'minutes',
                    'data' => $duration,
                    'borderWidth' => 0,
                    'borderRadius' => 3,
                    'backgroundColor' => '#3b73ed',
                ],
            ],
            'labels' => $departments,

        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
