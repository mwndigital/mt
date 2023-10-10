<?php

namespace App\Mail;

use App\Models\ContactFormSubmissions;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AdminContactFormSubmissionMail extends Mailable
{
    use Queueable, SerializesModels;

    public $contactFormSubmissions;

    /**
     * Create a new message instance.
     */
    public function __construct(contactFormSubmissions $contactFormSubmissions) {
        $this->contactFormSubmissions = $contactFormSubmissions;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Contact form submission',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.contactFormSubmission',
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
