<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Queue\SerializesModels;

class QrCodeEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $qrCodePath;

    /**
     * Create a new message instance.
     *
     * @param string $qrCodePath Path ke QR Code image
     */
    public function __construct($qrCodePath)
    {
        $this->qrCodePath = $qrCodePath;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'QR Code Anda',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.qr_code',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [
            Attachment::fromPath(storage_path('app/public/' . $this->qrCodePath))
                ->as('qr-code.png')
                ->withMime('image/png'),
        ];
    }
}

