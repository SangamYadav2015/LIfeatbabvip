<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RegisterUserMail extends Mailable
{
    use Queueable, SerializesModels;

    public $name;
    public $email;
    public $password;
    public $subject;

    /**
     * Create a new message instance.
     *
     * @param string $name
     * @param string $email
     * @param string $password
     * @param string $subject
     */
    public function __construct($name, $email, $password, $subject)
    {
        $this->name = $name ?? ''; // Ensure it's a string
        $this->email = $email ?? ''; // Ensure it's a string
        $this->password = $password ?? ''; // Ensure it's a string
        $this->subject = $subject ?? ''; // Ensure it's a string
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        return $this->view('emails.registerUser')
            ->subject($this->subject);
    }
}
