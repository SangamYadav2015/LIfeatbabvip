<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class InvalidLoginAttempt extends Mailable
{
    use Queueable, SerializesModels;

    public $email;
    public $ipAddress;
    public $subject;

    /**
     * Create a new message instance.
     *
     * @param string $email
     * @param string $ipAddress
     * @param string $subject
     */
    public function __construct($email, $ipAddress, $subject)
    {
        $this->email = $email ?? ''; // Ensure it's a string
        $this->ipAddress = $ipAddress ?? ''; // Ensure it's a string
        $this->subject = $subject ?? ''; // Ensure it's a string
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        return $this->view('emails.invalidLogin')
            ->subject($this->subject);
    }
}
