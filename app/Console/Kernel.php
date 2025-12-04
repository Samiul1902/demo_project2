<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * Commands in app/Console/Commands are auto-discovered in recent Laravel
     * versions, so this array can stay empty unless you want to force‑register.[file:1]
     *
     * @var array<int, class-string<\Illuminate\Console\Command>>
     */
    protected $commands = [
        // \App\Console\Commands\SendAppointmentReminders::class,
    ];

    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // Automated SMS/Email reminder prototype for upcoming appointments (FR‑19).[file:1]
        // This runs every day at 18:00 and calls the custom command:
        // php artisan ssbp:send-reminders
        //
        // The command itself creates rows in notification_logs for bookings
        // scheduled for tomorrow with status Pending or Approved.
        $schedule->command('ssbp:send-reminders')->dailyAt('18:00');
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
