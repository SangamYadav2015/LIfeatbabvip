<?php
namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\DatabaseMessage;

class StatusUpdated extends Notification
{
    use Queueable;

    public $status;
    public $applicant_name;
    public $job_title;
    public $offer_letter_link;
    public $applicant_id;
    public $job_id;

    /**
     * Create a new notification instance.
     *
     * @param  string  $status
     * @param  string  $applicant_name
     * @param  string  $job_title
     * @param  string  $offer_letter_link
     * @param  int  $applicant_id
     * @param  int  $job_id
     * @return void
     */
    public function __construct($status, $applicant_name, $job_title = null, $offer_letter_link = null, $applicant_id = null, $job_id = null)
    {
        $this->status = $status;
        $this->applicant_name = $applicant_name;
        $this->job_title = $job_title;
        $this->offer_letter_link = $offer_letter_link;
        $this->applicant_id = $applicant_id;
        $this->job_id = $job_id;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database']; // We're using the database channel
    }

    /**
     * Build the database notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\DatabaseMessage
     */
    public function toDatabase($notifiable)
    {
        $message = "
        <div style='font-family: Arial, sans-serif; padding: 20px; border: 1px solid #ccc; border-radius: 10px;'>";

        // Create message based on the applicant's status
        if ($this->status === 'hired') {
            $message .= "
                <h2 style='color: #2d87f0;'>Offer Letter: Congratulations {$this->applicant_name}</h2>
                <p>We are excited to offer you the position of <strong>{$this->job_title}</strong> at our company.</p>
            ";
        } elseif ($this->status === 'rejected') {
            $message .= "
                <h2 style='color: #f44336;'>Sorry, you have not been selected for the position of {$this->job_title}</h2>
                <p>Unfortunately, after careful consideration, we have decided to move forward with other candidates. We appreciate your interest in the position and encourage you to apply for future openings.</p>";
        }

        // Add footer
        $message .= "
                <footer style='margin-top: 30px;'>
                    <p>Best regards, <br> The Team</p>
                </footer>
            </div>";

        // Return the notification data
        return new DatabaseMessage([
            'message' => $message,
            'status' => $this->status,
            'applicant_name' => $this->applicant_name,
            'job_title' => $this->job_title,
            'offer_letter_link' => $this->offer_letter_link,
            'applicant_id' => $this->applicant_id,  // Adding applicant_id
            'job_id' => $this->job_id,              // Adding job_id
        ]);
    }
}
