<?php 
// app/Mail/JoiningLetterMail.php

namespace App\Mail;

use App\Models\Applicant;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;


class JoiningLetterMail extends Mailable
{
    use Queueable, SerializesModels;

    public $applicant;
    public $jobTitle;

    /**
     * Create a new message instance.
     *
     * @param  Applicant  $applicant
     * @param  string  $jobTitle
     * @return void
     */
    public function __construct(Applicant $applicant, $jobTitle)
    {
        $this->applicant = $applicant;
        $this->jobTitle = $jobTitle;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // Customize the joining letter message
        return $this->view('emails.joining_letter') // Use the view for the joining letter email
                    ->subject('Your Joining Letter')
                    ->with([
                        'applicantName' => $this->applicant->full_name,
                        'jobTitle' => $this->jobTitle,
                    ]);
    }
}
