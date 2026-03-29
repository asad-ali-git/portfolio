<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreContactMessageRequest;
use App\Http\Resources\ContactMessageResource;
use App\Jobs\SendUnreadMessageReminder;
use App\Mail\ContactMessageReceived;
use App\Models\ContactMessage;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    /**
     * Store a new contact message from the public portfolio.
     */
    public function store(StoreContactMessageRequest $request): JsonResponse
    {
        $message = ContactMessage::create($request->validated());

        // Send initial notification email
        $this->sendNotificationEmail($message);

        // Schedule reminder email for unread messages
        $this->scheduleUnreadReminder($message);

        return response()->json([
            'message' => 'Thank you! Your message has been received. I will get back to you soon.',
            'data'    => new ContactMessageResource($message),
        ], 201);
    }

    /**
     * Send notification email to configured recipients.
     */
    private function sendNotificationEmail(ContactMessage $message): void
    {
        $notificationEmails = $this->getNotificationEmails();

        // dd($notificationEmails);

        if (empty($notificationEmails)) {
            return;
        }

        foreach ($notificationEmails as $email) {
            Mail::to($email)->queue(new ContactMessageReceived($message));
        }
    }

    /**
     * Schedule reminder emails for unread messages.
     */
    private function scheduleUnreadReminder(ContactMessage $message): void
    {
        $reminderInterval = config('contact.reminder_interval_minutes', 1440);

        SendUnreadMessageReminder::dispatch($message)
            ->delay(now()->addMinutes($reminderInterval));
    }

    /**
     * Parse comma-separated emails from configuration.
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
