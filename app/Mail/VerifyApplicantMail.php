<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class VerifyApplicantMail extends Mailable
{
    use Queueable, SerializesModels;

    public $first_name;
    public $url;

    public function __construct($first_name, $url)
    {
        $this->first_name = $first_name;
        $this->url = $url;
    }

    public function build()
    {
        return $this->view('emails.verify-applicant')
                    ->subject('Verify your email address')
                    ->with([
                        'first_name' => $this->first_name,
                        'url'        => $this->url,
                    ]);
    }
}
