<?php

namespace App\Console\Commands;

use App\Jobs\SendUnreadMessageReminder;
use App\Models\ContactMessage;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;

class SendUnreadMessageReminders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'contact-messages:send-reminders';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send reminder emails for unread contact messages at configured intervals';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $reminderInterval = config('contact.reminder_interval_minutes', 1440);
        $reminderThreshold = now()->subMinutes($reminderInterval);

        // Find unread messages that haven't received a reminder yet (created before threshold)
        $messages = ContactMessage::unread()
            ->where('created_at', '<=', $reminderThreshold)
            ->get();

        if ($messages->isEmpty()) {
            $this->info('No unread messages requiring reminders.');
            return 0;
        }

        foreach ($messages as $message) {
            SendUnreadMessageReminder::dispatch($message);
            $this->line("Scheduled reminder for message #{$message->id} from {$message->name}");
        }

        $this->info("Scheduled {$messages->count()} reminder email(s).");

        return 0;
    }
}
