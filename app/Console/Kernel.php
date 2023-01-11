<?php

namespace App\Console;

use App\Http\Controllers\Driver\AvailabilityController;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param Schedule $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule): void
    {
         $schedule->command('availability:task', ['1'])
             ->everyMinute();
//             ->weekly()
//             ->saturdays()
//             ->at('20:00')
//             ->timezone('Europe/Amsterdam');

         $schedule->command('availability:task', ['2'])
             ->everyMinute();
//             ->weekly()
//             ->sundays()
//             ->at('20:00')
//             ->timezone('Europe/Amsterdam');
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
