<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewRequest extends Mailable
{
    use Queueable, SerializesModels;

    private $clientRequest;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($clientRequest, $password)
    {
        $this->clientRequest = $clientRequest;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject("New Password Requested")
            ->view('emails.new_request')->with([
                'clientRequest' => $this->clientRequest
            ]);
    }
}
