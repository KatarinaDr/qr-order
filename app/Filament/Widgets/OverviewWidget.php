<?php

namespace App\Filament\Widgets;

use App\Models\Article;
use App\Models\Rtable;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use DateTime;
use Illuminate\Support\Facades\Auth;

class OverviewWidget extends BaseWidget
{
    protected function getStats(): array
    {
//        $monthlyOfsTaxpayerCounts = $this->getMonthlyCounts(OfsTaxpayer::class);
//        $monthlyOfsBusinessLocationCounts = $this->getMonthlyCounts(OfsBusinessLocation::class);
//        $monthlyOfsBusinessLocationDeviceCounts = $this->getMonthlyCounts(OfsBusinessLocationDevice::class);

        $user = Auth::user();
        $stats = [];

        if ($user && $user->role && $user->role->name === 'super_admin'){
            $stats[] = Stat::make('Broj korisnika:', User::count() - 1)
                ->description('Ukupan broj korisnika')
                ->color('primary')
                ->icon('heroicon-o-users');
        }

        if ($user && $user->role && $user->role->name === 'manager'){
            $dailyArticlesCounts = $this->getDailyCounts(Article::class);
            $dailyTablesCounts = $this->getDailyCounts(Rtable::class);

            $stats[] = Stat::make('Broj artikala:', Article::count())
                ->description('Artikli')
                ->color('success')
                ->icon('heroicon-o-shopping-bag')
                ->chart($dailyArticlesCounts)
                ->chartColor('success');

            $stats[] = Stat::make('Broj stolova:', Rtable::count())
                ->description('Stolovi')
                ->color('info')
                ->icon('heroicon-o-building-office')
                ->chart($dailyTablesCounts)
                ->chartColor('info');

            $stats[] = $this->getLicenseStat();
        }

        return $stats;
    }

    private function getMonthlyCounts($modelClass): array
    {
        $monthlyCounts = $modelClass::selectRaw('MONTH(created_at) as day, COUNT(*) as count')
            ->groupBy('month')
            ->orderBy('month')
            ->get()
            ->pluck('count', 'month')
            ->toArray();

        $allMonths = range(1, 12);

        return array_map(function ($month) use ($monthlyCounts) {
            return $monthlyCounts[$month] ?? 0;
        }, $allMonths);
    }


    private function getDailyCounts($modelClass): array
    {

        $dailyCounts = $modelClass::selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->where('created_at', '>=', now()->subDays(14))
            ->groupBy('date')
            ->orderBy('date')
            ->get()
            ->pluck('count', 'date')
            ->toArray();


        $startDate = new DateTime();
        $startDate->modify('-14 days');

        // Create a DateTime object for now
        $endDate = new DateTime();

        // Create an array to hold the dates
        $allDays = [];

        // Loop from the start date to the end date
        while ($startDate <= $endDate) {
            // Format the date and add it to the array
            $allDays[] = $startDate->format('Y-m-d');

            // Move to the next day
            $startDate->modify('+1 day');
        }
        return array_map(function ($day) use ($dailyCounts) {
            return $dailyCounts[$day] ?? 0;
        }, $allDays);
    }

    private function getLicenseStat(): Stat
    {
        $user = Auth::user();

        $now = now();
        $expiresAt = \Carbon\Carbon::parse($user->license_expires_at);

        $daysRemaining = $now->startOfDay()->diffInDays($expiresAt->startOfDay());

        return Stat::make('Licenca', "{$daysRemaining} dana")
            ->description('Do isteka licence')
            ->color($daysRemaining <= 7 ? 'warning' : 'success')
            ->icon('heroicon-o-clock');
    }
}
