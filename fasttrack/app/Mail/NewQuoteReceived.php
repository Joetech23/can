<?php

namespace App\Mail;

use App\Models\Quote;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NewQuoteReceived extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public Quote $quote)
    {
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'New quote request '.$this->quote->reference.' · '.$this->quote->from_postcode.' → '.$this->quote->to_postcode,
            replyTo: [$this->quote->email],
        );
    }

    public function content(): Content
    {
        return new Content(
            markdown: 'mail.staff.new-quote',
        );
    }
}
