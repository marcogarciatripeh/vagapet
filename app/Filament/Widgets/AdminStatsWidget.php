<?php

namespace App\Filament\Widgets;

use App\Models\User;
use App\Models\ProfessionalProfile;
use App\Models\CompanyProfile;
use App\Models\Job;
use App\Models\JobApplication;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class AdminStatsWidget extends BaseWidget
{
    protected static ?int $sort = 1;
    
    protected int | string | array $columnSpan = 'full';
    
    protected function getColumns(): int
    {
        return 3;
    }

    protected function getStats(): array
    {
        // Total de usuários
        $totalUsers = User::count();
        $newUsersToday = User::whereDate('created_at', today())->count();
        $newUsersThisMonth = User::whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();

        // Total de profissionais
        $totalProfessionals = ProfessionalProfile::count();
        $newProfessionalsThisMonth = ProfessionalProfile::whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();

        // Total de empresas
        $totalCompanies = CompanyProfile::count();
        $newCompaniesThisMonth = CompanyProfile::whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();

        // Total de vagas
        $totalJobs = Job::count();
        $activeJobs = Job::active()->count();
        $newJobsThisMonth = Job::whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();

        // Total de candidaturas
        $totalApplications = JobApplication::count();
        $pendingApplications = JobApplication::where('status', 'pending')->count();
        $approvedApplications = JobApplication::where('status', 'approved')->count();
        $newApplicationsToday = JobApplication::whereDate('created_at', today())->count();

        // Calcular taxa de aprovação
        $approvalRate = $totalApplications > 0 
            ? round(($approvedApplications / $totalApplications) * 100, 1) 
            : 0;

        return [
            Stat::make('Total de Usuários', number_format($totalUsers, 0, ',', '.'))
                ->description($newUsersToday > 0 ? "{$newUsersToday} novos hoje" : ($newUsersThisMonth > 0 ? "{$newUsersThisMonth} novos este mês" : "Sem novos usuários"))
                ->descriptionIcon('heroicon-m-users')
                ->color('primary')
                ->chart($this->getUsersChartData()),

            Stat::make('Profissionais', number_format($totalProfessionals, 0, ',', '.'))
                ->description($newProfessionalsThisMonth > 0 ? "{$newProfessionalsThisMonth} novos este mês" : "Sem novos profissionais")
                ->descriptionIcon('heroicon-m-user')
                ->color('success')
                ->chart($this->getProfessionalsChartData()),

            Stat::make('Empresas', number_format($totalCompanies, 0, ',', '.'))
                ->description($newCompaniesThisMonth > 0 ? "{$newCompaniesThisMonth} novas este mês" : "Sem novas empresas")
                ->descriptionIcon('heroicon-m-building-office')
                ->color('warning')
                ->chart($this->getCompaniesChartData()),

            Stat::make('Vagas Publicadas', number_format($totalJobs, 0, ',', '.'))
                ->description("{$activeJobs} ativas" . ($newJobsThisMonth > 0 ? " • {$newJobsThisMonth} novas este mês" : ""))
                ->descriptionIcon('heroicon-m-briefcase')
                ->color('info')
                ->chart($this->getJobsChartData()),

            Stat::make('Candidaturas', number_format($totalApplications, 0, ',', '.'))
                ->description("{$pendingApplications} pendentes • {$approvedApplications} aprovadas")
                ->descriptionIcon('heroicon-m-document-text')
                ->color('danger')
                ->chart($this->getApplicationsChartData()),

            Stat::make('Taxa de Aprovação', $approvalRate . '%')
                ->description("{$approvedApplications} de {$totalApplications} candidaturas")
                ->descriptionIcon('heroicon-m-check-circle')
                ->color('success')
                ->chart([$approvalRate]),
        ];
    }

    protected function getUsersChartData(): array
    {
        $data = [];
        for ($i = 11; $i >= 0; $i--) {
            $month = \Carbon\Carbon::now()->subMonths($i);
            $data[] = User::whereYear('created_at', $month->year)
                ->whereMonth('created_at', $month->month)
                ->count();
        }
        return $data;
    }

    protected function getProfessionalsChartData(): array
    {
        $data = [];
        for ($i = 11; $i >= 0; $i--) {
            $month = \Carbon\Carbon::now()->subMonths($i);
            $data[] = ProfessionalProfile::whereYear('created_at', $month->year)
                ->whereMonth('created_at', $month->month)
                ->count();
        }
        return $data;
    }

    protected function getCompaniesChartData(): array
    {
        $data = [];
        for ($i = 11; $i >= 0; $i--) {
            $month = \Carbon\Carbon::now()->subMonths($i);
            $data[] = CompanyProfile::whereYear('created_at', $month->year)
                ->whereMonth('created_at', $month->month)
                ->count();
        }
        return $data;
    }

    protected function getJobsChartData(): array
    {
        $data = [];
        for ($i = 11; $i >= 0; $i--) {
            $month = \Carbon\Carbon::now()->subMonths($i);
            $data[] = Job::whereYear('created_at', $month->year)
                ->whereMonth('created_at', $month->month)
                ->count();
        }
        return $data;
    }

    protected function getApplicationsChartData(): array
    {
        $data = [];
        for ($i = 11; $i >= 0; $i--) {
            $month = \Carbon\Carbon::now()->subMonths($i);
            $data[] = JobApplication::whereYear('created_at', $month->year)
                ->whereMonth('created_at', $month->month)
                ->count();
        }
        return $data;
    }
}

