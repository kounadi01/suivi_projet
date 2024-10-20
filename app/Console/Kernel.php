<?php

namespace App\Console;

use App\Jobs\EnvoiDeMailJob;
use Carbon\Carbon;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();
        $date = Carbon::parse('2024-09-8 13:20:00');

        // Planification du job
        EnvoiDeMailJob::dispatch()->delay($date);

        // Planification à 00h
        // $schedule->command('send:emails')->daily();
        // Planification à 01h
        // $schedule->command('send:emails')->dailyAt('01:00');

        // Planifier le job à une date spécifique
        // $schedule->job(new EnvoiDeMailJob)
        //          ->dailyAt('14:00'); // Exemple : exécuter tous les jours à 14h
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
