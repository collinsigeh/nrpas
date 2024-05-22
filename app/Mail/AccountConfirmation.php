<?php

namespace App\Mail;

use App\Models\Tempuser;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AccountConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    private Tempuser $tempuser;

    /**
     * Create a new message instance.
     */
    public function __construct(Tempuser $tempuser)
    {
        $this->tempuser = $tempuser;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Confirm Your Account on '. config('app.name', 'NRPAS')
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.account_confirmation',
            with: [
                'tempuser' => $this->tempuser
            ],
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
}
