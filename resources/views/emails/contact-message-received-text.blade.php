New Contact Message

You have received a new message from {{ $contactMessage->name }}.

From: {{ $contactMessage->email }}
Date: {{ $contactMessage->created_at->format('M d, Y H:i') }}

Message:
{{ $contactMessage->message }}

Dashboard:
{{ config('app.url') }}/admin/contact-messages
