<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

/**
 * Notifies the responsible business unit of a new website enquiry.
 */
class EnquiryReceived extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @param  array<string, mixed>  $enquiry
     * @param  array<string, string>  $campaign
     */
    public function __construct(public array $enquiry, public string $unit, public array $campaign = []) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            replyTo: [new Address($this->enquiry['email'], $this->enquiry['name'])],
            subject: 'New website enquiry: '.config('acpl.enquiry_types.'.$this->enquiry['enquiry_type']).' — '.$this->enquiry['name'],
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.enquiry',
        );
    }
}
