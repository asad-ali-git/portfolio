<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Contact Message Notification Emails
    |--------------------------------------------------------------------------
    |
    | Comma-separated list of emails that should receive notifications when
    | a new contact message is submitted. Reminders are sent at intervals
    | for unread messages.
    |
    | Example: 'admin@example.com,support@example.com'
    |
    */
    'notification_emails' => env('CONTACT_NOTIFICATION_EMAILS', ''),

    /*
    |--------------------------------------------------------------------------
    | Reminder Interval
    |--------------------------------------------------------------------------
    |
    | Number of minutes to wait before sending a reminder email for unread
    | messages. Default is 24 hours (1440 minutes).
    |
    */
    'reminder_interval_minutes' => env('CONTACT_REMINDER_INTERVAL', 1440),
];
