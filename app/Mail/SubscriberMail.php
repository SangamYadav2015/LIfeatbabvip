<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SubscriberMail extends Mailable
{
    use Queueable, SerializesModels;

    public $email;

    public function __construct($email)
    {
    $this->email = $email ?? ''; 
    }

   
    public function build()
    {
        return $this->view('emails.subscriber')
                    ->subject("NewsLetter Subscriber");
    }
}
