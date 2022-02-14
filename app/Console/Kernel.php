<?php

namespace App\Console;

use App\Console\Commands\SendEmailVerificationReminderCommand;
use App\Console\Commands\SendNewLetterCommand;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected $commands = [
        SendNewLetterCommand::class,
        SendEmailVerificationReminderCommand::class
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

        //Send Newsletter every Monday To Verified Accounts
        $schedule->command(SendNewLetterCommand::class)->withoutOverlapping()->onOneServer()->mondays();

        //Send a Reminder of Verification Email after seven days daily
        $schedule->command(SendEmailVerificationReminderCommand::class)->onOneServer()->daily();
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
