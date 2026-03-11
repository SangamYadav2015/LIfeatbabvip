<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ApplicantRegisterMail extends Mailable
{
    use Queueable, SerializesModels;

    use Queueable, SerializesModels;

    public $email;

    public function __construct($email)
    {
    $this->email = $email ?? ''; 
    }

   
    public function build()
    {
        return $this->view('emails.applicant_register')
                    ->subject("Applicant Registration Confirmation");
    }
}
