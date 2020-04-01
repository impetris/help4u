<?php

namespace App\Mail;

use App\Person;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class InquiryCreated extends Mailable
{
    use Queueable, SerializesModels;

    /** @var Person */
    protected $person;

    /**
     * InquirieCreated constructor.
     *
     * @param  Person  $person
     */
    public function __construct(Person $person)
    {
        $this->person = $person;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Neue Anfrage')->markdown('emails.inquiry.created', ['person' => $this->person]);
    }
}
