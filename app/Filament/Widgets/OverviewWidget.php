<?php

namespace App\Filament\Widgets;

use App\Models\Article;
use App\Models\Rtable;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use DateTime;

class OverviewWidget extends BaseWidget
{
    protected function getStats(): array
    {
//        $monthlyOfsTaxpayerCounts = $this->getMonthlyCounts(OfsTaxpayer::class);
//        $monthlyOfsBusinessLocationCounts = $this->getMonthlyCounts(OfsBusinessLocation::class);
//        $monthlyOfsBusinessLocationDeviceCounts = $this->getMonthlyCounts(OfsBusinessLocationDevice::class);

        $dailyArticlesCounts = $this->getDailyCounts(Article::class);
        $dailyTablesCounts = $this->getDailyCounts(Rtable::class);

        return [
            Stat::make('Number of articles:', Article::count())
                ->description('Articles')
                ->color('success')
                ->icon('heroicon-o-users')
                ->chart($dailyArticlesCounts)
                ->chartColor('success'),

            Stat::make('Number of tables:', Rtable::count())
                ->description('Tables')
                ->color('info')
                ->icon('heroicon-o-building-office')
                ->chart($dailyTablesCounts)
                ->chartColor('info'),

        ];
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
}
