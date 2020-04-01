<?php

namespace App\Mail;

use App\Enquirer;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EnquirerCreated extends Mailable
{
    use Queueable, SerializesModels;

    /** @var Enquirer */
    protected $enquirer;

    /**
     * EnquirerCreated constructor.
     *
     * @param  Enquirer  $enquirer
     */
    public function __construct(Enquirer $enquirer)
    {
        $this->enquirer = $enquirer;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.enquirer.created', ['enquirer' => $this->enquirer]);
    }
}
