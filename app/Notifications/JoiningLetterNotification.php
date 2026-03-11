<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\DatabaseMessage;
use Illuminate\Support\Str;

class JoiningLetterNotification extends Notification
{
    use Queueable;

    public $applicant_name;
    public $job_title;
    public $joining_letter_link;

    /**
     * Create a new notification instance.
     *
     * @param  string  $applicant_name
     * @param  string  $job_title
     * @param  string  $joining_letter_link
     * @return void
     */
    public function __construct($applicant_name, $job_title, $joining_letter_link)
    {
        $this->applicant_name = $applicant_name;
        $this->job_title = $job_title;
        $this->joining_letter_link = $joining_letter_link;
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
        $notificationId = Str::uuid();

        // Create message for Joining Letter notification
        $message = "
        <div style='font-family: Arial, sans-serif; padding: 20px; border: 1px solid #ccc; border-radius: 10px;'>
            <h2 style='color: #4caf50;'>Joining Letter: Welcome {$this->applicant_name}</h2>
            <p>Congratulations on accepting the offer! We are pleased to welcome you to the team.</p>
            <p>You can download your <a href='{$this->joining_letter_link}'>Joining Letter</a> to complete the process.</p>
            <footer style='margin-top: 30px;'>
                <p>Best regards, <br> The Team</p>
            </footer>
        </div>";

        // Returning the DatabaseMessage for Joining Letter
        return new DatabaseMessage([
            'id' => $notificationId,
            'message' => $message,
            'applicant_name' => $this->applicant_name,
            'job_title' => $this->job_title,
            'joining_letter_link' => $this->joining_letter_link,
        ]);
    }
}
