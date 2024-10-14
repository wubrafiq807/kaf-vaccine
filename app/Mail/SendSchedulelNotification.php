<?php

namespace App\Mail;

use App\Models\VaccineRegister;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SendSchedulelNotification extends Mailable
{
    use Queueable, SerializesModels;

    protected VaccineRegister $register;

    /**
     * Create a new message instance.
     */
    public function __construct(VaccineRegister $register)
    {
        $this->register = $register;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Your vaccine schedule is tomorrow',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mail.schedule-notification',
            with: ['register' => $this->register],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
