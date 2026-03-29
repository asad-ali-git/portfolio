<?php

namespace App\Jobs;

use App\Mail\ContactMessageReceived;
use App\Models\ContactMessage;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendUnreadMessageReminder implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(public ContactMessage $message)
    {
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        // Check if message is still unread before sending reminder
        if ($this->message->fresh()->is_read) {
            return;
        }

        // Get comma-separated emails from environment variable
        $notificationEmails = $this->getNotificationEmails();

        if (empty($notificationEmails)) {
            return;
        }

        // Send reminder email to each notification email
        foreach ($notificationEmails as $email) {
            Mail::to($email)->send(new ContactMessageReceived($this->message));
        }
    }

    /**
     * Parse comma-separated emails from environment variable.
     *
     * @return array
     */
    private function getNotificationEmails(): array
    {
        $emailsString = config('contact.notification_emails', '');

        if (empty($emailsString)) {
            return [];
        }

        return array_filter(
            array_map('trim', explode(',', $emailsString)),
            fn($email) => !empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL)
        );
    }
}
