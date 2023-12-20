<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class PasswordResetEmail extends Mailable
{
    use Queueable, SerializesModels;

    protected $details;

    /**
     * Create a new message instance.
     */
    public function __construct($details)
    {
        $this->details = $details;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: '[' . env('APP_NAME', "") . ']비밀번호 변경 안내',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        $options = array(
            'reset_link' => route('password.reset.view', ['token' => $this->details['link']]),
        );

        return new Content(
            view: 'email.reset-password',
            with: $options
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }

    public function failed($e)
    {
        Log::error("email send failed = " . $e);
    }
}
