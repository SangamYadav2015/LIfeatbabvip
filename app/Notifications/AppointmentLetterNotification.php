<?php
namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\DatabaseMessage;

class AppointmentLetterNotification extends Notification
{
    use Queueable;

    public $applicant_name;
    public $job_title;
    public $appointment_letter_link;

    /**
     * Create a new notification instance.
     *
     * @param  string  $applicant_name
     * @param  string  $job_title
     * @param  string  $appointment_letter_link
     * @return void
     */
    public function __construct($applicant_name, $job_title, $appointment_letter_link)
    {
        $this->applicant_name = $applicant_name;
        $this->job_title = $job_title;
        $this->appointment_letter_link = $appointment_letter_link;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
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
        <div style='font-family: Arial, sans-serif; padding: 20px; border: 1px solid #ccc; border-radius: 10px;'>
            <h2 style='color: #4CAF50;'>Appointment Letter: Your official appointment as {$this->job_title}</h2>
            <p>We are pleased to inform you that your appointment has been confirmed.</p>
            <p>Click the link below to download your official appointment letter:</p>
            <p><a href='{$this->appointment_letter_link}' target='_blank'>Download Appointment Letter</a></p>
            <footer style='margin-top: 30px;'>
                <p>Best regards, <br> The Team</p>
            </footer>
        </div>";

        return new DatabaseMessage([
            'message' => $message,
            'applicant_name' => $this->applicant_name,
            'job_title' => $this->job_title,
            'appointment_letter_link' => $this->appointment_letter_link,
        ]);
    }
}
