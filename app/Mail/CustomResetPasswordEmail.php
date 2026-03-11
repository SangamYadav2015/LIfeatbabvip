<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CustomResetPasswordEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $token;
    public $name;
    public $email;

    public function __construct($token, $name, $email)
    {
        $this->token = $token;
        $this->name = $name;
        $this->email = $email;
    }

    public function build()
    {
        return $this->view('emails.custom_reset_password')
                    ->subject('Password Reset Request')
                    ->with([
                        'token' => $this->token,
                        'name' => $this->name,
                        'email' => $this->email
                    ]);
    }
}
