<?php

namespace App\Filament\Widgets;

use App\Models\JobApplication;
use Filament\Widgets\ChartWidget;

class ApplicationsChartWidget extends ChartWidget
{
    protected static ?string $heading = 'Candidaturas por Status';
    
    protected static ?int $sort = 3;
    
    protected static ?string $description = 'Distribuição de candidaturas por status';
    
    protected int | string | array $columnSpan = [
        'md' => 1,
        'xl' => 1,
    ];

    protected function getData(): array
    {
        $pending = JobApplication::where('status', 'pending')->count();
        $approved = JobApplication::where('status', 'approved')->count();
        $rejected = JobApplication::where('status', 'rejected')->count();

        return [
            'datasets' => [
                [
                    'label' => 'Candidaturas',
                    'data' => [$pending, $approved, $rejected],
                    'backgroundColor' => [
                        'rgb(239, 68, 68)',   // Vermelho para pendentes
                        'rgb(34, 197, 94)',   // Verde para aprovadas
                        'rgb(107, 114, 128)', // Cinza para rejeitadas
                    ],
                ],
            ],
            'labels' => ['Pendentes', 'Aprovadas', 'Rejeitadas'],
        ];
    }

    protected function getType(): string
    {
        return 'doughnut';
    }

    protected function getOptions(): array
    {
        return [
            'plugins' => [
                'legend' => [
                    'display' => true,
                    'position' => 'bottom',
                ],
            ],
        ];
    }
}

