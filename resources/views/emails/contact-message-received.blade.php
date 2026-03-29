<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Contact Message</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 20px;
            min-height: 100vh;
        }
        .wrapper { max-width: 600px; margin: 0 auto; }
        .email-container {
            background: white;
            border-radius: 12px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 40px 30px;
            text-align: center;
        }
        .header h1 {
            font-size: 28px;
            font-weight: 600;
            margin-bottom: 5px;
            letter-spacing: -0.5px;
        }
        .header p {
            font-size: 14px;
            opacity: 0.9;
        }
        .content {
            padding: 40px 30px;
        }
        .greeting {
            font-size: 16px;
            color: #333;
            margin-bottom: 25px;
            line-height: 1.6;
        }
        .greeting strong {
            color: #667eea;
            font-weight: 600;
        }
        .info-section {
            background: #f8fafc;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 25px;
            border-left: 4px solid #667eea;
        }
        .info-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 12px;
            font-size: 14px;
            color: #555;
        }
        .info-row:last-child {
            margin-bottom: 0;
        }
        .info-label {
            font-weight: 600;
            color: #333;
            min-width: 80px;
        }
        .info-value {
            color: #667eea;
            word-break: break-all;
        }
        .message-box {
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            border-radius: 8px;
            padding: 25px;
            margin: 25px 0;
            border-left: 5px solid #667eea;
        }
        .message-label {
            font-size: 13px;
            font-weight: 600;
            color: #667eea;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 12px;
            display: block;
        }
        .message-content {
            font-size: 15px;
            color: #333;
            line-height: 1.8;
            white-space: pre-wrap;
            word-wrap: break-word;
        }
        .cta-section {
            text-align: center;
            margin: 30px 0;
        }
        .button {
            display: inline-block;
            padding: 14px 35px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            text-decoration: none;
            border-radius: 6px;
            font-weight: 600;
            font-size: 15px;
            transition: transform 0.2s, box-shadow 0.2s;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
        }
        .button:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(102, 126, 234, 0.6);
        }
        .divider {
            height: 1px;
            background: #e5e7eb;
            margin: 30px 0;
        }
        .footer {
            background: #f8fafc;
            padding: 25px 30px;
            text-align: center;
            border-top: 1px solid #e5e7eb;
        }
        .footer-text {
            font-size: 12px;
            color: #888;
            line-height: 1.6;
        }
        .footer-highlight {
            color: #667eea;
            font-weight: 600;
        }
        .timestamp {
            font-size: 12px;
            color: #999;
            margin-top: 15px;
            font-style: italic;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="email-container">
            <!-- Header -->
            <div class="header">
                <h1>📧 New Message Received</h1>
                <p>You have a new contact message waiting for you</p>
            </div>

            <!-- Content -->
            <div class="content">
                <div class="greeting">
                    Hello! 👋<br>
                    You just received a message from <strong>{{ $contactMessage->name }}</strong>
                </div>

                <!-- Sender Info -->
                <div class="info-section">
                    <div class="info-row">
                        <span class="info-label">From:</span>
                        <span class="info-value">{{ $contactMessage->email }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Date:</span>
                        <span class="info-value">{{ $contactMessage->created_at->format('M d, Y \a\t H:i') }}</span>
                    </div>
                </div>

                <!-- Message -->
                <div class="message-box">
                    <span class="message-label">💬 Message:</span>
                    <div class="message-content">{{ $contactMessage->message }}</div>
                </div>

                <!-- CTA Button -->
                <div class="cta-section">
                    <a href="{{ config('app.url') }}/admin/contact-messages" class="button">
                        View & Respond in Dashboard →
                    </a>
                </div>

                <div class="timestamp">
                    Received on {{ $contactMessage->created_at->format('l, F jS Y \a\t g:i A') }}
                </div>
            </div>

            <!-- Footer -->
            <div class="footer">
                <p class="footer-text">
                    This is an automated notification from <span class="footer-highlight">{{ config('app.name') }}</span><br>
                    Please respond to messages through your admin dashboard to keep everything organized.
                </p>
                <p class="footer-text" style="margin-top: 12px; font-size: 11px; color: #aaa;">
                    © {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
                </p>
            </div>
    </div>
</body>
</html>
