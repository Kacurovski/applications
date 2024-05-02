<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class MailTrap extends Mailable
{
    use Queueable, SerializesModels;
    public $email;
    public $phone;
    public $company;    
    public function __construct($email, $phone, $company)
    {
        $this->email = $email;
        $this->phone = $phone;
        $this->company = $company;           
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Mail Chimp',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mail.mailchip-email',
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
