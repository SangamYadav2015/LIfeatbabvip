<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OfferLetterMail extends Mailable
{
    use Queueable, SerializesModels;

    public $applicant;
    public $jobTitle;
    public $offerLetterPdfUrl;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($applicant, $jobTitle, $offerLetterPdfUrl)
    {
        $this->applicant = $applicant;
        $this->jobTitle = $jobTitle;
        $this->offerLetterPdfUrl = $offerLetterPdfUrl;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject("Offer Letter for {$this->jobTitle}")
                    ->view('emails.offer_letter')  // You can create a Blade template for the email content
                    ->with([
                        'applicantName' => $this->applicant->full_name,
                        'jobTitle' => $this->jobTitle,
                    ])
                    ->attach($this->offerLetterPdfUrl, [
                        'as' => 'offer_letter.pdf',
                        'mime' => 'application/pdf',
                    ]);
    }
}
