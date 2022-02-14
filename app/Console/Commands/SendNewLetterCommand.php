<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use App\Notifications\newsletterNotification;

class SendNewLetterCommand extends Command
{
    protected $signature = 'send:newsletter {emails?*} {--s|schedule: must be Excute or not}';

    protected $description = 'Send An Email To Every User that has its account Verified';

    public function handle()
    {
        $userEmails = $this->argument('emails');
        $schedule = $this->option('schedule');

        $builder = User::query();

        if ($userEmails) {
            $builder->whereIn('email', $userEmails);
        }

        $builder->whereNotNull('email_verified_at');

        if ($count = $builder->count()) {
            $this->info("{$count} mails will be sent");

            if ($this->confirm('Are you Sure?')) {
                $this->output->progressStart($count);
                $builder->each(function (User $user) {
                    $user->notify(new NewsletterNotification());
                    $this->output->progressAdvance();
                });
                $this->output->progressFinish();
                $this->info('mails sent');
                return;
            }
        }

        $this->info('emails were not sent');
    }
}
