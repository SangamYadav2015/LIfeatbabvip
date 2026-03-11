<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactUsMail extends Mailable
{
    use Queueable, SerializesModels;

    public $name;
    public $email;
    public $phone;
    public $subject;
    public $messageContent;

    /**
     * Create a new message instance.
     *
     * @param string $name
     * @param string $email
     * @param string $phone
     * @param string $subject
     * @param string $messageContent
     */
    public function __construct($name, $email, $phone, $subject, $messageContent)
    {
    $this->name = $name ?? ''; // Ensure it's a string
    $this->email = $email ?? ''; // Ensure it's a string
    $this->phone = $phone ?? ''; // Ensure it's a string
    $this->subject = $subject ?? ''; // Ensure it's a string
    $this->messageContent = $messageContent ?? ''; // Ensure it's a string
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
    
        return $this->view('emails.contact')
                    ->subject($this->subject);
    }
}
