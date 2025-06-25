<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Console\Commands\PrintOrder;

class Kernel extends ConsoleKernel
{
    protected $commands = [
        \App\Console\Commands\PrintOrder::class,
        \App\Console\Commands\SeedRolesAndPermissions::class,
        \App\Console\Commands\CreateUser::class,
        \App\Console\Commands\PrintUsbOrder::class,
        \App\Console\Commands\SeedAllDataCommand::class,
    ];

    protected function schedule(Schedule $schedule)
    {
        // Define scheduled tasks if needed
    }

    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
